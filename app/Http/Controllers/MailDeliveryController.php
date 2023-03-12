<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\NewsletterJob;
use App\Models\Subscriber;
use App\Models\MailDelivery;
use Illuminate\Support\Facades\Mail;

class MailDeliveryController extends Controller
{
    public function sendMails(Request $request){
        $request->validate([
            'message' => 'required',
        ]);
        $this->clearMailDelivery();
        $subscribers = Subscriber::all();
        foreach($subscribers as $subscriber){
            $data = [
                'subscriber_id' => $subscriber->id,
                'name' => $subscriber->name,
                'email' => $subscriber->email,
                'message' => $request->message,
            ];
            dispatch(new NewsletterJob($data));
        }
        $request->session()->flash('message', 'Emails are on the way. Refresh the page to check the status');
        return redirect()->back();
    }
    public function clearMailDelivery(){
        $deliveries = MailDelivery::all();
        foreach($deliveries as $delivery){
            $delivery->delete();
        }
    }
}
