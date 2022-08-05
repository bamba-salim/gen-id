<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKeywordType extends Model
{
    use HasFactory;

    public function keywords()
    {
        return $this->hasMany(UserKeyword::class);
    }
}
