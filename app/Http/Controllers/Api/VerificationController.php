<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
     */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $keyResolver;

    public function __construct() {}

    public function verify(Request $request)
    {

        $url = stripslashes($request->url);
        $userId = explode('/', explode('?', $url)[0]);
        $userId = end($userId);
        $user = User::where('id', $userId)->first();
        if (!$user) {
            return response()->json(['status' => 0, 'message' => trans('auth.Invalid_Signature'), 'result' => null]);
        }
        $request = Request::create($url);

        if ($request->hasValidSignature()) {

            if (!empty($user->email_verified_at)) {
                return response()->json(['status' => 0, 'message' => trans('auth.account_already_verified'), 'result' => null]);
            }

            // Send welcome mail to user
            $mail_data = [
                'email_id' => 3,
                'user_id' => $user->id,
                'email' => $user->email,
            ];

            dispatch(new SendEmailJob($mail_data));

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }

            if ($user->role_id == 4) {
                if ($user->is_active == 0) {
                    return response()->json(['status' => 0, 'message' => trans('auth.Your_account_is_not_activated_please_activated_first'), 'result' => null]);
                } else if ($user->is_active == 2) {
                    return response()->json(['status' => 0, 'message' => trans('auth.Your_account_is_not_deactivated'), 'result' => null]);
                } else {
                    $user = User::select("id", "name", "email", "photo", "email_verified_at", "is_active")->where('id', $user->id)->first();
                    $token = $user->createToken(env('APP_NAME'))->plainTextToken;;

                    $user['token'] = $token;
                    return response()->json(['status' => 200, 'message' => trans('auth.Logged_in_successfully'), 'result' => $user]);
                }
            } else {
                return response()->json(['status' => 0, 'message' => trans('auth.sufficient_permissions_app'), 'result' => null]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => trans('auth.Invalid_Signature'), 'result' => null]);
        }
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['status' => 0, 'message' => trans('auth.account_already_verified'), 'result' => null]);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['status' => 200, 'message' => trans('auth.Resend_activation_link_please_activate_your_account'), 'result' => null]);
    }
}
