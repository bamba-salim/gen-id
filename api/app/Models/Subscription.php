<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $hidden = [
        'api_key_id'
    ];

    public function key(){
        return $this->belongsTo(ApiKey::class, "api_key_id",'id');
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }
}
