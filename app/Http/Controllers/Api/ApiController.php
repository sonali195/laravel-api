<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Helpers\Helper;
use App\Models\Contact;
use App\Models\Country;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\NotificationResource;

class ApiController extends Controller
{
    /**
     * contact
     *
     * @param  mixed $request
     * @return void
     */
    public function contact(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'subject' => "required|string|max:255",
                'message' => "required|string|max:2000",
            ], [
                'subject.required' => trans('app.Please_enter_a_subject'),
                'message.required' => trans('app.Please_enter_a_message'),
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            $user = Auth::user();

            $contact = Contact::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'subject' => $request->subject,
                'message' => $request->message
            ]);

            if ($contact) {
                // Send contact enquiry mail to admin
                $mail_data = [
                    'email_id' => 6,
                    'user_id' => 1,
                    'name' => $contact->name,
                    'email' => $contact->email,
                    'subject' => $contact->subject,
                    'message' => $contact->message,
                ];

                dispatch(new SendEmailJob($mail_data));

                DB::commit();
                return response()->json(['status' => 200, 'message' => trans('app.Enquiry_has_been_added'), 'result' => null]);
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

    // Terms and Conditions Page
    public function termsConditions(Request $request)
    {
        return response()->json(['status' => 200, 'message' => "", 'result' => route('app.terms-conditions')]);
    }

    // Privacy Policy Page
    public function privacyPolicy(Request $request)
    {
        return response()->json(['status' => 200, 'message' => "", 'result' => route('app.privacy-policy')]);
    }

    // About Us Page
    public function aboutUs(Request $request)
    {
        return response()->json(['status' => 200, 'message' => "", 'result' => route('app.about-us')]);
    }

    /**
     * Get Notifications
     *
     * @param  mixed $request
     * @return void
     */
    public function notifications(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'page' => 'required|integer',
                'per_page' => 'required|integer'
            ], [
                'page.required' => trans('app.Please_provide_a_page'),
                'per_page.required' => trans('app.Please_provide_a_per_page'),
            ]);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }

            $user_id = Auth::id();

            $notifications = NotificationService::getNotification(['user_id' => $user_id, 'paginate' => $request->per_page ?? 10]);

            NotificationService::readNotification(['user_id' => $user_id]);

            $notifications = NotificationResource::collection($notifications->items());

            return response()->json(['status' => 200, 'message' => "Notification list", 'result' => $notifications]);
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /**
     * Clear Notifications
     *
     * @param  mixed $request
     * @return void
     */
    public function notificationsClear(Request $request)
    {
        DB::beginTransaction();
        try {
            $user_id = Auth::id();

            $res = NotificationService::clearNotifications($user_id);

            if ($res['status'] == 200 || $res['status'] == true) {
                DB::commit();
            }

            return response()->json($res);
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }

    /**
     * Country
     *
     * @return void
     */
    public function country()
    {
        try {
            $country = Country::select("id", "name")->get();

            return response()->json(['status' => 200, 'message' => trans('app.Country_found'), 'result' => $country]);
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }


    /**
     * Masters
     *
     * @return void
     */
    public function masters()
    {
        try {
            $country = Country::select("id", "name")->get();

            $data = [
                'countries' => $country,
                'terms_conditions_link' => route('app.terms-conditions'),
                'privacy_policy_link' =>  route('app.privacy-policy'),
                'cancellation_policy_link' => route('app.cancellation-policy'),
                'about_us_link' => route('app.about-us'),
            ];

            return response()->json(['status' => 200, 'message' => trans('app.Master_found'), 'result' => $data]);
        } catch (Throwable $e) {
            report($e);
            return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
        }
    }
}
