<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'orders';
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

    public function getOrderStatus(){
        $order_status = [
            PROCESSING => "處理中",
            COMPLETED => "已完成",
            CANCELED => "已取消"];

        return $order_status[$this->status];
    }

    public function getPaymentStatus(){
        $payment_status = [
            UNPAID => "未付款",
            PAID => "已付款",
            REFUNDING => "退款中",
            REFUNDED => "已退款"];

        return $payment_status[$this->payment_status];
    }


    public function getDeliveryStatus(){
        $delivery_status = [
            WAITING => "待出貨",
            DELIVERING => " 運送中",
            DELIVERED => " 已送達"];

        return $delivery_status[$this->delivery_status];
    }

    public function totalSales(){

    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user(){
        return $this->belongsTo("App\Models\User");
    }

    public function items(){
        return $this->hasMany("App\Models\OrderItem");
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

    public function getPaymentTypeAttribute(){
        $payment_type = [
            "Credit_CreditCard" => "信用卡"
        ];
        return isset($payment_type[$this->attributes["payment_type"]]) ? $payment_type[$this->attributes["payment_type"]] : "";
    }
}
