<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'img', 'price', 'quantity', 'bought', 'user_id', 'categoria'];

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_post')
                    ->withPivot('product_id', 'quantity', 'user_id')
                    ->withTimestamps();
    }
}
