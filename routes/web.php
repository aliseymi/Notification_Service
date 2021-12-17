<?php

use App\Http\Controllers\NotificationsController;
use App\Mail\TopicCreated;
use App\Models\User;
use App\Services\Notifications\Notification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('notification/email', [NotificationsController::class, 'email'])->name('notification.form.email');
