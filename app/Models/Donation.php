<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'donor_email',
        'donor_name',
        'stripe_session_id',
        'stripe_payment_intent_id',
        'stripe_customer_id',
        'amount_total',
        'currency',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];
}
