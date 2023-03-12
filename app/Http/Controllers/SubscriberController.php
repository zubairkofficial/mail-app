<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function index(){
        $subscribers = Subscriber::with('mail_delivery')->get();
        return view('app', get_defined_vars());
    }
}
