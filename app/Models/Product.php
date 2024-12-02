<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    //relation with brands table
    public function category()
    {
        return $this->hasone(Category::class,'id', 'category_id');
    }
    //relation with brands table
    public function brand()
    {
        return $this->hasone(Brand::class,'id', 'brand_id');
    }

    //delivery
    public function delivery()
    {
        return $this->hasone(Delivery_place::class,'id', 'delivery_place_id');
    }
    //relation with owners table
    public function owner()
    {
        return $this->hasone(Product_woner::class,'id', 'woner_id');
    }

    //relation with user table
    public function user()
    {
        return $this->hasone(User::class,'id', 'user_id');
    }

    //bidder
    public function first_bidder()
    {
        return $this->hasone(Bidder_register::class,'id', 'auction_max_bidder_id');
    }
    //bidder
    public function second_bidder()
    {
        return $this->hasone(Bidder_register::class,'id', 'auction_2ndmax_bidder_id');
    }

}
