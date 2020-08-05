<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    public $thickness = 0;
    public $total_length = 0;

    protected $table = 'products';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];


    protected $appends = array('thickness', 'total_length', 'realPrice');

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
    public function category(){
        return $this->belongsTo("App\Models\ProductCategory", 'category_id');
    }

    public function colors(){
        return $this->belongsToMany("App\Models\Color", "product_colors", "product_id", "color_id");
    }

    public function shipping_methods(){
        return $this->belongsToMany("App\Models\ShippingMethod", "product_shipping_methods", "product_id", "shipping_method_id");
    }

    public function brand(){
        return $this->belongsTo("App\Models\Brand", "brand_id", "id");
    }
    public function origin(){
        return $this->belongsTo("App\Models\Origin", "origin_id", "id");
    }
    public function piece(){
        return $this->belongsTo("App\Models\Piece", "piece_id", "id");
    }

    public function orders(){
        return $this->belongsToMany("App\Models\Order", "order_items", "product_id", "order_id");
    }

    public function orderItems(){
        return $this->hasMany("App\Models\OrderItem", "product_id", "id");
    }

    public function reviews(){
        return $this->hasMany("App\Models\OrderItem", "product_id", "id")
            ->join("orders", "order_items.order_id", "=", "orders.id")
            ->join("users", "orders.user_id", "=", "users.id")
            ->where("review", "!=", null)
            ->select("order_items.*");
    }

    public function ratings(){
        return $this->hasMany("App\Models\OrderItem", "product_id", "id")->select("rating");
    }

    public function orderItem(){
        $relation = $this->hasOne("App\Models\OrderItem")
            ->select("order_items.*")
            ->join("orders", "order_items.order_id", "=", "orders.id")
            ->where("orders.user_id", "=", Auth::user()->id);

        return $relation;
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

    public function getPermalinkAttribute(){
        return route("product_detail", ["slug" => $this->slug]);
    }

    public function getColornameAttribute(){
        $colors = [];
        foreach ($this->colors as $color){
            $colors[] = $color->name;
        }

        return $colors;
    }

    public function getImagesAttribute(){

        if(empty($this->attributes['images'])) return [];
        return json_decode($this->attributes['images']);
    }

    public function setImagesAttribute($value){

        $this->attributes['images'] = json_encode($value);
    }

    public function setIs_hotAttribute($is_hot){
        return $this->attributes['is_hot'] = $is_hot;
    }

    public function getAverageRatingAttribute(){

        if($this->custom_rating != null && $this->custom_rating > 0){
            return $this->custom_rating;
        }
        else{
            $ratings = array_reduce($this->ratings->toArray(), function ($t, $e){
                $t[] = (int) $e['rating'];
                return $t;
            }, []);
            $ratings = array_filter($ratings, function ($e){
                return $e > 0;
            });

            if(count($ratings) > 0){
                return array_sum($ratings) / count($ratings);
            }

            else return null;
        }
    }

    public function getIsAvailableAttribute(){
        return $this->status !== PRE_ORDER && $this->stock > 0;
    }

    public function getRealPriceAttribute(){

        $realPrice = $this->sale_price != null ? $this->sale_price : $this->price;

        if($this->type == FRAME){
            return round($realPrice + $this->thickness + $this->total_length * 2*1.2);
        }
        elseif($this->type == NORMAL){
            return round($realPrice);
        }

    }


    public function getThicknessAttribute(){
        return $this->thickness;
    }

    public function getTotalLengthAttribute(){
        return $this->total_length;
    }

}
