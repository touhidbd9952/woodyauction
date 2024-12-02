<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidder_register extends Model
{
    use HasFactory;

    protected $guarded = [];

    //relation with user table
    public function user()
    {
        return $this->hasone(User::class,'id', 'user_id');
    }
}
