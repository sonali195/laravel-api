<?php

namespace App\Http\Controllers\Api;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Helper;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /*
		*	Login
		*	@return \Illuminate\Http\JsonResponse
	*/
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:255',
                'password' => 'required|string|max:255',
                // 'fcm_token' => 'required',
                // 'platform' => 'required', // android, iOS
            ], [
                'email.required' => trans('app.Please_enter_a_email_address'),
                'password.required' => trans('app.Please_enter_a_password'),
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            $credentials = $request->only('email', 'password');
            $token = null;

            if (!Auth::attempt($credentials)) {
                $exists = User::where('email', $request->email)->exists();
                if ($exists) {
                    return response()->json(['status' => 0, 'message' => trans('auth.Invalid_password'), 'result' => null]);
                }
                return response()->json(['status' => 0, 'message' => trans('auth.Invalid_password_Please_try_again'), 'result' => null]);
            }


            /** @var \App\User @user */
            $user = Auth::user();
            $token = null;
            $token = $user->createToken(env('APP_NAME'))->plainTextToken;
            $user->auth_token = $token;

            if (!is_null($token)) {
                if ($user->role_id == 2) {
                    if ($user->is_active == 0) {
                        return response()->json(['status' => 0, 'message' => trans('auth.Your_account_is_not_activated_please_activated_first'), 'result' => null]);
                    } else if ($user->is_active == 2) {
                        return response()->json(['status' => 0, 'message' => trans('auth.Your_account_is_not_deactivated'), 'result' => null]);
                    } else {
                        $user = UserService::getUsers(['id' => $user->id]);

                        if ($request->fcm_token != "" && $request->platform != "") {
                            $user->login_devices()->updateOrCreate(
                                [
                                    'fcm_token' => $request->fcm_token,
                                    'is_signout'  => 0
                                ],
                                [
                                    'platform'  => $request->platform,
                                    'login_date'  => date('Y-m-d H:i:s'),
                                    'device_model'  => $request->device_model ?? null,
                                    'device_manufacture'  => $request->device_manufacture ?? null,
                                    'device_os_version'  => $request->device_os_version ?? null
                                ]
                            );
                        }

                        $user->auth_token = $token;

                        $user = UserResource::make($user);

                        return response()->json(['status' => 200, 'message' => trans('auth.Logged_in_successfully'), 'result' => $user]);
                    }
                } else {
                    return response()->json(['status' => 0, 'message' => trans('auth.sufficient_permissions_app'), 'result' => null]);
                }
            }
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /*
		*	Login
		*	@return \Illuminate\Http\JsonResponse
	*/
    public function loginWithPhone(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'country_code' => 'required|string',
                'phone_number' => 'required|numeric|digits_between:7,15',
                // 'fcm_token' => 'required',
                // 'platform' => 'required', // android, iOS
            ], [
                'country_code.required' => trans('app.Please_select_a_country'),
                'phone_number.required' => trans('app.Please_enter_a_phone_number'),
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            $user = User::where('country_code', $request->country_code)
                ->where('phone_number', $request->phone_number)
                ->first();

            // Check user account is activated
            if ($request->has('is_phone_check') && $request->is_phone_check == 1) {
                if ($user) {
                    if ($user->role_id == 2) {
                        if ($user->is_active == 0) {
                            return response()->json(['status' => 0, 'message' => trans('auth.Your_account_is_not_activated_please_activated_first'), 'result' => null]);
                        } else if ($user->is_active == 2) {
                            return response()->json(['status' => 0, 'message' => trans('auth.account_deactivate'), 'result' => null]);
                        }
                    }
                }
                return response()->json(['status' => 200, 'message' => trans('New User'), 'result' => null]);
            }

            $token = null;

            if (!$user) {
                $user = User::create([
                    'country_code' => $request->country_code,
                    'phone_number' => $request->phone_number,
                    'role_id' => 2,
                    'is_active' => 1,
                    'is_complete_profile' => 0,
                ]);
            }

            $token = null;
            $token = $user->createToken(env('APP_NAME'))->plainTextToken;
            $user->auth_token = $token;

            if (!is_null($token)) {
                if ($user->role_id == 2) {
                    if ($user->is_active == 0) {
                        return response()->json(['status' => 0, 'message' => trans('auth.Your_account_is_not_activated_please_activated_first'), 'result' => null]);
                    } else if ($user->is_active == 2) {
                        return response()->json(['status' => 0, 'message' => trans('auth.Your_account_is_not_deactivated'), 'result' => null]);
                    } else {
                        $user = UserService::getUsers(['id' => $user->id]);

                        if ($request->fcm_token != "" && $request->platform != "") {
                            $user->login_devices()->updateOrCreate(
                                [
                                    'fcm_token' => $request->fcm_token,
                                    'is_signout'  => 0
                                ],
                                [
                                    'platform'  => $request->platform,
                                    'login_date'  => date('Y-m-d H:i:s'),
                                    'device_model'  => $request->device_model ?? null,
                                    'device_manufacture'  => $request->device_manufacture ?? null,
                                    'device_os_version'  => $request->device_os_version ?? null
                                ]
                            );
                        }

                        $user->auth_token = $token;

                        $user = UserResource::make($user);

                        return response()->json(['status' => 200, 'message' => trans('auth.Logged_in_successfully'), 'result' => $user]);
                    }
                } else {
                    return response()->json(['status' => 0, 'message' => trans('auth.sufficient_permissions_app'), 'result' => null]);
                }
            }
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /*
    *   Social Login
    *   @return \Illuminate\Http\JsonResponse
    */
    public function socialLogin(Request $request)
    {
        // Add this 2 fields in users table - social_id(string), login_type(int)
        try {
            $validator = Validator::make($request->all(), [
                'social_id' => 'required',
                'email' => 'nullable|email|max:255',
                'login_type' => 'required|max:255',
                // 'fcm_token' => 'required',
                // 'platform' => 'required', // Android, iOS
            ], [
                'email.required' => trans('app.Please_provide_your_email'),
                'email.email' => trans('app.Please_enter_a_valid_email_address'),
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            if ($request->has('email') && $request->email != "") {
                $user = User::where(['email' => $request->email, 'deleted_at' => null])->first();

                if (!empty($user) && $user->login_type == 0) {
                    return response()->json(['status' => 0, 'message' => trans('app.This_email_is_already_taken'), 'result' => null]);
                }

                if (!empty($user) && ($user->login_type == 1 || $user->login_type == 2) && $user->social_id != $request->social_id) {
                    return response()->json(['status' => 0, 'message' => trans('app.This_email_already_exists_in_other_user_account'), 'result' => null]);
                }
            }

            $user_data = [
                'email' => $request->email ?? null,
                'is_active' => 1,
                'role_id' => 2,
            ];

            $user = User::updateOrCreate(['social_id' => $request->social_id, 'login_type' => $request->login_type], $user_data);

            if (!empty($user)) {
                if ($request->fcm_token != "" && $request->platform != "") {
                    if ($request->fcm_token != "" && $request->platform != "") {
                        $user->login_devices()->updateOrCreate(
                            [
                                'fcm_token' => $request->fcm_token,
                                'is_signout'  => 0
                            ],
                            [
                                'platform'  => $request->platform,
                                'login_date'  => date('Y-m-d H:i:s'),
                                'device_model'  => $request->device_model ?? null,
                                'device_manufacture'  => $request->device_manufacture ?? null,
                                'device_os_version'  => $request->device_os_version ?? null
                            ]
                        );
                    }
                }

                Auth::loginUsingId($user->id);

                /** @var \App\User @user */
                $user = Auth::user();
                $token = $user->createToken(env('APP_NAME'))->plainTextToken;

                $user = UserService::getUsers(['id' => $user->id]);

                $user->auth_token = $token;

                $user = UserResource::make($user);

                return response()->json(['status' => 200, 'message' => trans('auth.Registration_has_been_completed_successfully'), 'result' => $user]);
            }
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /*
		*	Register
		*	@return \Illuminate\Http\JsonResponse
	*/
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,null,id,deleted_at,NULL',
                'password' => 'required|string|min:8|max:18',
                'country_code' => 'required|string|max:255',
                'phone_number' => 'required|numeric|digits_between:7,15',
            ], [
                'email.required' => trans('app.Please_enter_a_email_address'),
                'email.email' => trans('app.Please_enter_a_valid_email_address'),
                'email.unique' => trans('app.This_email_is_already_taken'),
                'password.required' => trans('app.Please_enter_a_password'),
                'name.required' => trans('app.Please_enter_a_full_name'),
                'country_code.required' => trans('app.Please_select_a_county'),
                'phone_number.required' => trans('app.Please_enter_a_phone_number'),
                'phone_number.numeric' => trans('app.Phone_number_is_not_valid'),
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            $user_data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'country_code' => $request->country_code,
                'phone_number' => $request->phone_number,
                'is_active' => 1,
                'role_id' => 2,
            ];

            $user = User::create($user_data);

            if ($user) {
                if ($request->fcm_token != "" && $request->platform != "") {
                    $user->login_devices()->updateOrCreate(
                        [
                            'fcm_token' => $request->fcm_token,
                            'is_signout'  => 0
                        ],
                        [
                            'platform'  => $request->platform,
                            'login_date'  => date('Y-m-d H:i:s'),
                            'device_model'  => $request->device_model ?? null,
                            'device_manufacture'  => $request->device_manufacture ?? null,
                            'device_os_version'  => $request->device_os_version ?? null
                        ]
                    );
                }

                $credentials = $request->only('email', 'password');
                $token = null;

                if (!Auth::attempt($credentials)) {
                    return response()->json(['status' => 0, 'message' => trans('auth.Invalid_password_Please_try_again'), 'result' => null]);
                }

                $token = $user->createToken(env('APP_NAME'))->plainTextToken;

                $user = UserService::getUsers(['id' => $user->id]);
                $user->auth_token = $token;

                $mail_data = [
                    'email_id' => 3,
                    'user_id' => $user->id,
                    'email' => $user->email,
                ];

                // Send Welcome mail to user
                dispatch(new SendEmailJob($mail_data));

                $user = UserResource::make($user);

                return response()->json(['status' => 200, 'message' => trans('auth.Registration_has_been_completed_successfully'), 'result' => $user]);
            } else {
                return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
            }
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /*
		*	Logout
		*	@return \Illuminate\Http\JsonResponse
	*/
    public function logout(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // 'platform' => 'required', // android, iOS
                // 'fcm_token' => 'required',
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            /** @var \App\User @user */
            $user = Auth::user();

            if ($request->platform != "" && $request->fcm_token != "") {
                $user->login_devices()->where(
                    [
                        'fcm_token' => $request->fcm_token,
                        'platform' => $request->platform
                    ]
                )
                    ->update(
                        [
                            'logout_date' => Carbon::now()->format('Y-m-d H:i:s'),
                            'is_signout'  => 1
                        ]
                    );
            }

            // Logout user from current devices
            $user->currentAccessToken()->delete();

            // Logout user from all devices
            // $user->tokens()->delete();

            return response()->json(['status' => 200, 'message' => trans('auth.Logged_out_successfully'), 'result' => null]);
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /*
		*	Forgot password
		*	@return \Illuminate\Http\JsonResponse
	*/
    public function forgotPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ], [
                'email.required' => trans('app.Please_enter_a_email_address'),
                'email.email' => trans('app.Please_enter_a_valid_email_address'),
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            $user = User::where('email', $request->email)->first();
            if (!empty($user)) {
                if ($user->is_active == 0) {
                    return response()->json(['status' => 0, 'message' => trans('auth.Your_account_is_not_activated_please_activated_first'), 'result' => null]);
                } else if ($user->is_active == 2) {
                    return response()->json(['status' => 0, 'message' => trans('auth.Your_account_is_not_deactivated'), 'result' => null]);
                } else {
                    $code = rand(111111, 999999);

                    $user->reset_code = $code;
                    $user->save();

                    // Send forgot password mail to user with code
                    $mail_data = [
                        'email_id' => 2,
                        'user_id' => $user->id,
                        'code' => $code
                    ];

                    dispatch(new SendEmailJob($mail_data));
                    return response()->json(['status' => 200, 'message' => trans('app.Code_sent_on_your_email'), 'result' => $code]);
                }
            } else {
                return response()->json(['status' => 0, 'message' => trans('passwords.user'), 'result' => null]);
            }
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /*
		*	Resend code
		*	@return \Illuminate\Http\JsonResponse
	*/
    public function resendCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ], [
                'email.required' => trans('app.Please_enter_a_email_address'),
                'email.email' => trans('app.Please_enter_a_valid_email_address'),
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            $user = User::where('email', $request->email)->first();
            if (!empty($user)) {
                $code = rand(111111, 999999);

                $user->reset_code = $code;
                $user->save();

                // Send forgot password mail to user with code
                $mail_data = [
                    'email_id' => 2,
                    'user_id' => $user->id,
                    'code' => $code
                ];

                dispatch(new SendEmailJob($mail_data));
                return response()->json(['status' => 0, 'message' => trans('app.Code_resend_successfully'), 'result' => $code]);
            } else {
                return response()->json(['status' => 0, 'message' => trans('auth.something_went_wrong'), 'result' => null]);
            }
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /*
		*	Reset password
		*	@return \Illuminate\Http\JsonResponse
	*/
    public function resetPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required|size:6',
                'password' => 'required|min:8|max:18',
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            $user = User::where('reset_code', $request->code)->first();
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();

                return response()->json(['status' => 200, 'message' => trans('auth.Reset_password_successfully'), 'result' => null]);
            } else {
                return response()->json(['status' => 0, 'message' => trans('auth.please_enter_correct_code'), 'result' => null]);
            }
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /*
		*	Change password
		*	@return \Illuminate\Http\JsonResponse
	*/
    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'password' => 'required|min:8|max:18',
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            $user_id = Auth::user()->id;
            $user = User::select("id", "password")->where('id', $user_id)->first();
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();

                return response()->json(['status' => 200, 'message' => trans('auth.password_changed_success'), 'result' => null]);
            } else {
                return response()->json(['status' => 0, 'message' => trans('auth.please_enter_correct_current_password'), 'result' => null]);
            }
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /*
		*	profile picture upload in temp directory
		*	@return \Illuminate\Http\JsonResponse
	*/
    public function uploadProfilePicture(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'photo' => 'required|mimes:jpg,png,jpeg|max:2000',
            ], [
                'photo.required' => trans('app.Please_upload_an_image'),
                'photo.mimes' => trans('app.Please_select_png_or_jpg_image'),
                'photo.max' => trans('app.Please_select_image_size', ['size' => '2 MB']),
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            $filename = null;
            if ($request->has('photo') && $request->file('photo') != "") {
                $image = $request->file('photo');
                $filename = 'Img-' . date('YmdHsi') . rand(1, 100) . '.' . $image->getClientOriginalExtension();
                Helper::uploadFile($image, config('constant.profile_image_url'), $filename);

                return response()->json([
                    'status' => 200,
                    'message' => "",
                    'result' => $filename
                ]);
            } else {
                DB::rollback();
                return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
            }
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /**
     * Complete Profile
     * @param  mixed $request
     * @return void
     */
    public function completeProfile(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'nullable|email|unique:users,email,' . $user_id . ',id,deleted_at,NULL|max:255',
                'country_code' => 'required|string|max:255',
                'phone_number' => 'required|numeric|digits_between:7,15',
                // 'country_code' => 'nullable|string|max:255',
                // 'phone_number' => 'nullable|numeric|unique:users,phone_number,' . $user_id . ',id,country_code,' . $request->country_code . ',deleted_at,NULL|digits_between:7,15',
            ], [
                'email.required' => trans('app.Please_enter_a_email_address'),
                'email.email' => trans('app.Please_enter_a_valid_email_address'),
                'email.unique' => trans('app.This_email_is_already_taken'),
                'password.required' => trans('app.Please_enter_a_password'),
                'name.required' => trans('app.Please_enter_a_full_name'),
                'country_code.required' => trans('app.Please_select_a_county'),
                'phone_number.required' => trans('app.Please_enter_a_phone_number'),
                'phone_number.numeric' => trans('app.Phone_number_is_not_valid'),
                'phone_number.unique' => trans('app.This_phone_number_is_already_taken'),
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            $user = User::select("*")->where(["id" => $user_id])->first();

            $user->name = $request->name;
            $user->is_complete_profile = 1;

            if ($request->has('phone_number') && $request->phone_number != "") {
                $user->country_code = $request->country_code;
                $user->phone_number = $request->phone_number;
            }

            if ($request->has('email')) {
                $user->email = $request->email;
            }

            if ($request->has('photo') && $request->photo != "") {
                $user->photo = $request->photo;
            }

            $user->save();

            if ($user) {
                DB::commit();

                $user = UserService::getUsers(['id' => $user_id]);

                $user = UserResource::make($user);

                return response()->json(['status' => 200, 'message' => trans('app.Profile_details_has_been_saved_successfully'), 'result' => $user]);
            } else {
                DB::rollback();
                return response()->json(['status' => 0, 'message' => trans('app.Error_Occurred_During_Save_Please_Try_Again'), 'result' => null]);
            }
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /*
		*	Get profile
		*	@return \Illuminate\Http\JsonResponse
	*/
    public function getProfile(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $user = UserService::getUsers(['id' => $user_id]);

            if ($user) {
                $user = UserResource::make($user);
                return response()->json(['status' => 200, 'message' => trans('app.Profile_Details_Is_Found'), 'result' => $user]);
            } else {
                return response()->json(['status' => 0, 'message' => trans('app.Profile_Details_Is_Not_Found'), 'result' => null]);
            }
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /*
		*	Update profile
		*	@return \Illuminate\Http\JsonResponse
	*/
    public function updateProfile(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'nullable|email|unique:users,email,' . $user_id . ',id,deleted_at,NULL|max:255',
                'country_code' => 'required|string|max:255',
                'phone_number' => 'required|numeric|digits_between:7,15',
                // 'country_code' => 'nullable|string|max:255',
                // 'phone_number' => 'nullable|numeric|unique:users,phone_number,' . $user_id . ',id,country_code,' . $request->country_code . ',deleted_at,NULL|digits_between:7,15',
            ], [
                'email.required' => trans('app.Please_enter_a_email_address'),
                'email.email' => trans('app.Please_enter_a_valid_email_address'),
                'email.unique' => trans('app.This_email_is_already_taken'),
                'password.required' => trans('app.Please_enter_a_password'),
                'name.required' => trans('app.Please_enter_a_full_name'),
                'country_code.required' => trans('app.Please_select_a_county'),
                'phone_number.required' => trans('app.Please_enter_a_phone_number'),
                'phone_number.numeric' => trans('app.Phone_number_is_not_valid'),
                'phone_number.unique' => trans('app.This_phone_number_is_already_taken'),
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            $user = User::select("*")->where(["id" => $user_id])->first();

            $user->name = $request->name;

            if ($request->has('phone_number') && $request->phone_number != "") {
                $user->country_code = $request->country_code;
                $user->phone_number = $request->phone_number;
            }

            if ($request->has('email')) {
                $user->email = $request->email;
            }

            if ($request->has('photo') && $request->photo != "") {
                $user->photo = $request->photo;
            }

            $user->save();

            if ($user) {
                DB::commit();

                $user = UserService::getUsers(['id' => $user_id]);

                $user = UserResource::make($user);

                return response()->json(['status' => 200, 'message' => trans('app.Profile_details_has_been_saved_successfully'), 'result' => $user]);
            } else {
                DB::rollback();
                return response()->json(['status' => 0, 'message' => trans('app.Error_Occurred_During_Save_Please_Try_Again'), 'result' => null]);
            }
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /**
     * DeleteUser - delete user account
     *
     * @return void
     */
    public function deleteAccount(Request $request)
    {
        try {
            /** @var \App\User @user */
            $user = Auth::user();
            if (!empty($user)) {
                $user->tokens()->delete();

                $user = User::where('id', $user->id)->first();
                $user->login_devices()
                    ->update(
                        [
                            'logout_date'  => date('Y-m-d H:i:s'),
                            'is_signout'  => 1
                        ]
                    );
                $user->delete();

                return response()->json(['status' => 200, 'message' => trans('auth.account_deleted'), 'result' => null]);
            }
            return response()->json(['status' => 0, 'message' => trans('auth.account_not_found'), 'result' => null]);
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /*
		*	Check email is verified
		*	@return \Illuminate\Http\JsonResponse
	*/
    public function checkEmailVerified(Request $request)
    {
        try {
            $user_id = Auth::user()->id;

            $user = UserService::getUsers(['id' => $user_id]);

            if (!empty($user) && $user->email_verified_at != null) {
                $user->is_email_verified = $user->email_verified_at != null ? 1 : 0;

                return response()->json(['status' => 200, 'message' => trans('app.Welcome_user', ['name' => $user->name]), 'result' => $user]);
            } else {
                return response()->json(['status' => 0, 'message' => trans('auth.account_not_verified'), 'result' => null]);
            }
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }
}
