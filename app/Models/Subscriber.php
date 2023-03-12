<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    /**
     * Get the mail_delivery associated with the Subscriber
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mail_delivery()
    {
        return $this->hasOne(MailDelivery::class);
    }
}
