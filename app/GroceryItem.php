<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class GroceryItem extends Model
{
     protected $fillable = [
        'name', 'user_id','description', 'image', 'fake_price','sell_price','category_id','subcategory_id','shop_id','status',
        'stock','stock_unit','detail','top_featured','gallery','detail_desc'
    ];

    protected $table = 'grocery_item';
    
    protected $appends = [ 'imagePath','shopName' , 'off', 'isWishlist','isCart','qtyCount', 'isInStock'];

    public function category()
    {
        return $this->hasOne('App\GroceryCategory', 'id', 'category_id');
    }

    public function subcategory()
    {
        return $this->hasOne('App\GrocerySubCategory', 'id', 'subcategory_id');
    }

    public function getImagePathAttribute()
    {
        return url('images/upload') . '/';
    }
    public function getShopNameAttribute()
    {
        return GroceryShop::find($this->attributes['shop_id'])->name;
    }
    public function getOffAttribute()
    {
        $cal = 100 - ($this->sell_price * 100) / $this->fake_price;
        return round($cal);
    }
   
    public function getIsWishlistAttribute()
    {
        if (Auth::check())
        {
            $has = Wishlist::where([['user_id',Auth::user()->id],['item_id',$this->attributes['id']]])->first();
            if(isset($has))
                return 1;
            return 0;
        } else
            return 0;
    }

    public function getIsCartAttribute()
    {
        $cart = session()->get('cart');
        if(isset($cart[$this->id]))
            return 1;
        else 
            return 0;
    }

    public function getQtyCountAttribute()
    {
        $cart = session()->get('cart');
        if(isset($cart[$this->id]))
            return $cart[$this->id]['qty'];
        else 
            return 1;
    }
    
    public function getIsInStockAttribute()
    {
        if($this->stock <= 0)
            return 0;
        return 1;
    }
}
