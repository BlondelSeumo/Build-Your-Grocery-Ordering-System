<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //
    protected $fillable = [
        'user_id', 'item_id'
    ];

    protected $table = 'user_wishlist';

    public function groceryItem()
    {
        return $this->hasOne('App\GroceryItem', 'id', 'item_id');
    }
}
