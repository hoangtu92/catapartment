<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'users';
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
    public function orders(){
        return $this->hasMany("App\Models\Order")->orderBy("id", "desc");
    }

    public function points_log(){
        return $this->hasMany("App\Models\UserPoint")->orderBy("id", "desc");
    }

    public function getConsumeAttribute(){
        $consume = 0;
        foreach ($this->orders as $order){
            $consume += $order->total_amount;
        }
        return $consume;
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

    public function hasPurchased($product_id){
        return $this->hasManyThrough("App\Models\OrderItem", "App\Models\Order")->where("product_id", "=", $product_id)->count() > 0;
    }

    public function orderItem ($product_id){
        return $this->hasManyThrough("App\Models\OrderItem", "App\Models\Order")->where("product_id", "=", $product_id)->first();
    }

}
