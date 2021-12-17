<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Jobs\SendSms;
use App\Models\User;
use App\Services\Notifications\Constants\EmailTypes;
use App\Services\Notifications\Exceptions\UserDoesNotHaveNumberException;
use App\Services\Notifications\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     *  show email form
     */
    public function email()
    {
        $users = User::all();
        $emailTypes = EmailTypes::toString();
        return view('notifications.send-email', compact('users', 'emailTypes'));
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'user' => 'required | integer | exists:users,id',
            'email_type' => 'required | integer'
        ]);

        try {
            $mailable = EmailTypes::toMailable($request->email_type);

            SendEmail::dispatch(User::find($request->user), new $mailable);

            return back()->with('success', __('notification.email_sent_successfully'));
        } catch (\Throwable $th) {
            return back()->with('failed', __('notification.email_has_problem'));
        }
    }

    /**
     * show sms form
     */
    public function sms()
    {
        $users = User::all();
        return view('notifications.send-sms', compact('users'));
    }

    public function sendSms(Request $request)
    {
        $request->validate([
            'user' => 'required | integer | exists:users,id',
            'text' => 'required | string | max:256'
        ]);

        try {
            $user = User::find($request->user);

            if(is_null($user->phone_number)){
                return back()->with('failed', __('notification.user_does_not_have_phone'));
            }

            SendSms::dispatch($user, $request->text);

            return $this->redirectBack('success', __('notification.sms_sent_successfully'));
        } catch (\Exception $e) {
            return $this->redirectBack('failed', __('notification.sms_has_problem'));
        }
    }

    protected function redirectBack(string $type, string $text)
    {
        return back()->with($type, $text);
    }
}
