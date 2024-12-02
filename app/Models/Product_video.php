<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_video extends Model
{
    use HasFactory;

    protected $guarded = [];

    //relation with user table
    public function product()
    {
        return $this->hasone(Product::class,'id', 'product_id');
    }

    //relation with user table
    public function user()
    {
        return $this->hasone(User::class,'id', 'user_id');
    }

}
