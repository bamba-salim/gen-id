<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class);
    }

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at'
    ];
}
