<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $fillable = ['title', 'wish_price', 'url', 'image_url', 'product_id'];
}
