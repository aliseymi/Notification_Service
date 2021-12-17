<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Notifications\Constants\EmailTypes;
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
}
