<?php

namespace App\Services\Notifications;

use App\Models\User;
use Ghasedak\Exceptions\ApiException;
use Ghasedak\Exceptions\HttpException;
use Ghasedak\GhasedakApi;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class Notification
{
    public function sendEmail(User $user, Mailable $mailable)
    {
        return Mail::to($user)->send($mailable);
    }

    public function sendSms(User $user, string $text)
    {
        try {
            $receptor = $user->phone_number;
            $line_number = config('services.ghasedakSms.line_number');
            $api_key = config('services.ghasedakSms.key');

            $api = new GhasedakApi($api_key);
            $api->SendSimple(
                $receptor,  // receptor
                $text, // message
                $line_number    // choose a line number from your account
            );
        } catch (ApiException $e) {
            throw $e;
        } catch (HttpException $e) {
            throw $e;
        }
    }
}
