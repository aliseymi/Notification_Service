<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Notifications\Constants\EmailTypes;
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
            $notification = resolve(Notification::class);

            $mailable = EmailTypes::toMailable($request->email_type);

            $notification->sendEmail(User::find($request->user), new $mailable);

            return back()->with('success', __('notification.email_sent_successfully'));
        }catch (\Throwable $th){
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
        return $request->all();
    }
}
