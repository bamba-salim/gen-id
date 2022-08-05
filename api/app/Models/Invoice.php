<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    use HasFactory;

    public function user(){
        return $this->hasOne(User::class);
    }

    public function subsciption(){
        return $this->hasOne(Subscription::class);
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }

    protected $hidden = [
        'payment_method_id'
    ];

}
