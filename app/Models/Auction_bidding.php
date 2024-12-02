<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction_bidding extends Model
{
    use HasFactory;
  
    protected $guarded = [];

    //relation with user table
    public function product()
    {
        return $this->hasone(Product::class,'id', 'product_id');
    }
    
    //relation with user table
    public function auction_product()
    {
        return $this->hasone(Auction_product::class,'id', 'auction_product_id');
    }
}
