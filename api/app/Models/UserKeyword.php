<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKeyword extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class);
    }

    public function type(){

        return $this->belongsTo(UserKeywordType::class,'user_keyword_type_id','id');
    }

    protected $hidden = [
        'user_id'
    ];
}
