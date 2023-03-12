<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\NewsletterMail;
use App\Models\MailDelivery;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\SentMessage;

class NewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = $this->data;
        $delivery = new MailDelivery();
        $delivery->subscriber_id = $data['subscriber_id'];
        if(Mail::send('Mails.NewsletterMail', ['data' => $data], function ($message) use ($data) {
                $message->from("info@rexpoplus.com", config('app.name'));
                $message->to($data['email'], $data['name'])->subject('Test Mail');
            }) instanceof SentMessage){
                $delivery->is_delivered = 1;
                $delivery->message = "Mail sent successfully";
            }else{
                $delivery->is_delivered = 0;
                $delivery->message = "Mail not sent successfully";
            }
        $delivery->save();
    }
}
