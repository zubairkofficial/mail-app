<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\MailDeliveryController;

Route::get('/', [SubscriberController::class, 'index']);
Route::post('mails/send', [MailDeliveryController::class, 'sendMails']);
