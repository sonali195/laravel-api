<?php

namespace App\Services;

use App\Jobs\SendEmailJob;
use Exception;
use Throwable;
use App\Models\User;
use App\Models\Notification;
use App\Models\UserLoginDevice;
use App\Models\NotificationReceiver;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\Messaging\NotFound;
use Kreait\Firebase\Exception\Messaging\ServerError;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class NotificationService
{

    /**
     *  Get Notifications
     *
     * @param  mixed $params
     * @return mixed
     */
    public static function getNotification($params = array())
    {
        try {
            $notification = Notification::select('notifications.*')
                ->when((isset($params['with_receiver']) && isset($params['user_id']) && !is_null($params['user_id'])), function ($query) use ($params) {
                    $query->selectRaw('notification_receivers.status');
                    $query->join('notification_receivers', 'notifications.id', 'notification_receivers.notification_id');
                    $query->where('receiver_id', $params['user_id']);
                })
                ->when((isset($params['with_sender']) && !is_null($params['with_sender'])), function ($query) {
                    $query->with('user:id,name,photo');
                })
                ->whereHas('receivers', function ($query) use ($params) {
                    if (isset($params['user_id']) && !is_null($params['user_id'])) {
                        $query->where('receiver_id', $params['user_id']);
                    }
                    if (isset($params['status']) && !is_null($params['status'])) {
                        $query->where('status', $params['status']);
                    }
                })
                ->orderBy('created_at', 'desc');

            // return only count
            if (isset($params['count']) && !is_null($params['count'])) {
                return $notification->count();
            }

            // return pagination for web
            if (isset($params['paginate']) && !is_null($params['paginate'])) {
                return $notification->paginate($params['paginate']);
            }

            return $notification->get();
        } catch (Throwable $e) {
            report('NotificationService ' . $e);
            return array();
        }
    }

    /**
     *  Read Notifications
     *
     * @param  mixed $params
     * @return mixed
     */
    public static function readNotification($params = array())
    {
        try {
            $notification = NotificationReceiver::where(["receiver_id" => $params['user_id'], 'status' => 0])
                ->update(['status' => 1]);

            return $notification;
        } catch (Throwable $e) {
            report('NotificationService ' . $e);
            return false;
        }
    }

    /**
     * NotificationsClear
     *
     * @author CK
     * @return mixed
     */
    public static function clearNotifications($user_id)
    {
        try {
            NotificationReceiver::orderBy('id', 'desc')
                ->where('receiver_id', $user_id)
                ->delete();

            return ['status' => 200, 'message' => trans('app.Notification_cleared_success'), 'result' => null];
        } catch (Throwable $e) {
            report('AppointmentService => ' . $e);
            return ['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null];
        }
    }

    /**
     * Send Notification
     *
     * @param  mixed $params
     * @return mixed
     */
    public static function sendNotification($params = [])
    {
        $notification = Notification::create([
            'title' => $params['title'] ?? null,
            'type' => $params['type'] ?? null,
            'text' =>  $params['text'] ?? null,
            'sender_id' => $params['sender_id'] ?? null,
            'redirect_on' => $params['redirect_on'] ?? null,
        ]);

        if ($notification) {
            $receivers = [];
            if (is_array($params['receiver_id'])) {
                foreach ($params['receiver_id'] as $receiver) {
                    $receivers[] = [
                        'receiver_id' => $receiver,
                        'status' => 0
                    ];
                }
            } else {
                $receivers[] = [
                    'receiver_id' => $params['receiver_id'],
                    'status' => 0
                ];
            }

            $notification->receivers()->createMany($receivers);

            $is_send_push_noti = $params['push_noti'] ?? false;

            $params = collect($params)->except(['text', 'type', 'receiver_id', 'push_noti', 'title'])->all();

            $others = collect($params)->except(['sender_id', 'redirect_on'])->all();
            if (!empty($others)) {
                $notification->others = json_encode($others);
                $notification->save();
            }

            if ($is_send_push_noti) {
                $receivers = collect($receivers)->pluck('receiver_id')->toArray();
                NotificationService::sendPushNotifications($receivers, $notification->text, $notification->title ?? config('app.name'), $notification->type, $params);
            }
        }
    }

    /**
     * Send push notifications
     *
     * @param array $receiverIds
     * @param string $message
     * @param string $title
     * @param mixed $type
     * @param array $params
     * @return void
     */
    public static function sendPushNotifications($receiverIds = [], $message = "", $title = "", $type = null, $params = [])
    {
        try {
            $receivers = User::select('id')
                ->whereIn('id', $receiverIds)
                ->with(
                    [
                        'login_devices' => function ($query) {
                            $query->whereNull('logout_date')
                                ->where('is_signout', 0)
                                ->whereNotNull('fcm_token');
                        }
                    ]
                )
                ->has('login_devices')
                ->get();

            if ($receivers->count()) {
                $deviceTokens = [];
                foreach ($receivers as $receiver) {
                    $deviceTokensTemp = collect($receiver->login_devices)->pluck('fcm_token')->toArray();
                    $deviceTokens = array_merge($deviceTokens, $deviceTokensTemp);
                }

                $deviceTokens = array_values(array_unique($deviceTokens));

                if (count($deviceTokens)) {
                    $badge = 0;
                    if (isset($params['badge']) && !empty($params['badge']) && $params['badge'] > 0) {
                        $badge = $params['badge'];
                    }

                    $data = [
                        'body' => (string) $message,
                        'title' => (string) $title,
                        'type' => (string) $type,
                        'badge' => (string) "0",
                        'sound' => (string) ($type == 0 ? "" : "default"),
                    ];

                    if (!empty($params)) {
                        $data = array_merge($data, $params);
                    }

                    $androidConfig = [
                        'priority' => 'high',
                        'notification' => [
                            'sound' => ($type == 0 ? "" : "default"),
                        ]
                    ];

                    $apnsConfig = [
                        'headers' => [
                            'apns-priority' => '10',
                        ],
                        'payload' => [
                            'aps' => [
                                'sound' => ($type == 0 ? "" : "default"),
                                'alert' => [
                                    'title' => $title,
                                    'body' => $message,
                                ],
                                'badge' => $badge,
                                'content-available' => 1,  // Content available flag for iOS
                                'mutable-content' => 1,
                            ],
                        ],
                    ];

                    // For silent notification
                    // if ($type == 0) {
                    // }

                    $messaging = app('firebase.messaging');

                    $notification = FirebaseNotification::create($title, $message);

                    $deviceTokensArray = [];
                    foreach ($deviceTokens as $key => $deviceToken) {
                        $message = CloudMessage::withTarget('token', $deviceToken)
                            ->withNotification($notification)
                            ->withData($data)
                            ->withAndroidConfig($androidConfig)
                            ->withApnsConfig($apnsConfig);
                        try {
                            $res = $messaging->send($message);
                            info($res);
                        } catch (NotFound $e) {
                            $deviceTokensArray[] = $deviceToken;
                            report($e);
                        } catch (ServerError $e) {
                            $deviceTokensArray[] = $deviceToken;
                            report($e);
                        } catch (FirebaseException $e) {
                            $deviceTokensArray[] = $deviceToken;
                            report($e);
                        } catch (Exception $e) {
                            $deviceTokensArray[] = $deviceToken;
                            report($e);
                        }
                    }
                    if (!empty($deviceTokensArray)) {
                        UserLoginDevice::whereIn('fcm_token', $deviceTokensArray)->delete();
                    }
                }
            }
        } catch (Throwable $e) {
            report('NotificationService ' . $e);
        }
    }

    /**
     * Send Notification To User
     *
     * @param  mixed $params
     * @return mixed
     */
    public static function sendCustomNotificationToUser($params = [])
    {
        $data = [
            'status' => 0,
            'message' => trans('app.something_went_wrong'),
            'result' => null
        ];

        $users = User::select('id')
            ->where('role_id', 2)
            ->where('is_active', 1)
            ->where('is_complete_profile', 1)
            ->get();

        if ($users->count()) {
            $users = collect($users)->pluck('id')->toArray();

            $notiParams =  $params;
            $notiParams['sender_id'] = 1;
            $notiParams['receiver_id'] = $users;
            $notiParams['push_noti'] = true;

            self::sendNotification($notiParams);

            $data['status'] = 200;
            $data['message'] = trans('app.Notification_send_success');
        } else {
            $data['message'] = trans('app.No_user_found_to_send_notification');
        }
        return $data;
    }

    /**
     * Send Notification To User
     *
     * @param  mixed $params
     * @return mixed
     */
    public static function sendEmailNotification($params = [])
    {
        $data = [
            'status' => 0,
            'message' => trans('app.something_went_wrong'),
            'result' => null
        ];

        $users = User::select('id')
            ->where(function ($query) use ($params) {
                $query->whereHas('notification_references', function ($query) use ($params) {
                    $query->where('type', 1);
                    $query->where('status', 1);
                });
                $query->orWhereDoesntHave('notification_references', function ($query) use ($params) {});
            })
            ->where('role_id', 2)
            ->where('is_active', 1)
            ->where('is_complete_profile', 1)
            ->get();

        if ($users->count()) {
            foreach ($users as $user) {
                $mail_data = [
                    'email_id' => 8,
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'user_id' => $user->id,
                    'title' => $params['title'] ?? "",
                    'text' => $params['text'] ?? "",
                ];
                dispatch(new SendEmailJob($mail_data));
            }

            $data['status'] = 200;
            $data['message'] = trans('app.Notification_send_success');
        } else {
            $data['message'] = trans('app.No_user_found_to_send_notification');
        }
        return $data;
    }
}
