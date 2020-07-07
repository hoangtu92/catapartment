<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'cart_items';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user(){
        return $this->belongsTo("users");
    }



    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function getCartDataAttribute(){

        $items = (array) json_decode($this->data);
        $cart_item_count = 0;
        $cart_total_amount = 0;

        //Loop through cart items to get total amount
        foreach ($items as $item){

            $cart_item_count += $item->qty;

            if(isset($item->product_id) && $item->product_id != null){
                $product = Product::find($item->product_id);

                if($product){

                    if(is_array($item->attr))
                        foreach($item->attr as $key => $value){
                            switch($key){
                                case "thickness":
                                    $product->thickness = $value;
                                    break;
                                case "total_length":
                                    $product->total_length = $value;
                                    break;
                            }
                        }

                    $permalink = $product->permalink;

                    $item->product = $product->toArray();
                    $item->product['permalink'] = $permalink;

                    $item->product = (object) $item->product;


                    $cart_total_amount += $item->product->realPrice*$item->qty;
                }

            }

        }

        return [
            'count' => $cart_item_count,
            'total' => round($cart_total_amount),
            'items' => $items
        ];

    }


}
