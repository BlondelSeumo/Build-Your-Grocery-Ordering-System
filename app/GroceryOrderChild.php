<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroceryOrderChild extends Model
{
    //

    protected $fillable = [
        'order_id', 'item_id', 'price','quantity','shop_id','unit','unit_qty'
    ];
    protected $table = 'grocery_order_child';
    
    protected $appends = [ 'itemName'];
    public function getItemNameAttribute()
    {
        if($this->attributes['item_id'] != null){
            $item =  GroceryItem::where('id',$this->attributes['item_id'])->first();
            if($item){
                return $item->name;
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }
    
}
