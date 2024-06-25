<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'cart_post')
                    ->withPivot('product_id', 'quantity')
                    ->withTimestamps();
    }
}
