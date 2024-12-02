<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionHistory extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    //relation with product table
    public function product()
    {
        return $this->hasone(Product::class,'id', 'product_id');
    }

    //relation with product table
    public function bidder()
    {
        return $this->hasone(Bidder_register::class,'id', 'bidder_id');
    }
}
