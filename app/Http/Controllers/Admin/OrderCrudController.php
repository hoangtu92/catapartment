<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\UserPoint;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Log;

/**
 * Class OrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrderCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Order');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/order');
        $this->crud->setEntityNameStrings(trans('backpack::site.order'), trans('backpack::site.orders'));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();

        $this->crud->addFilter(
            [
                'type' => 'dropdown',
                'name' => 'status',
                'label' => "訂單狀態",
            ],
            function () {
                return [
                    -1 => "All",
                    PROCESSING => "處理中",
                    COMPLETED => "已完成",
                    CANCELED => "已取消"];
            },
            function ($value) {
                if($value >=0)
                    $this->crud->addClause('where', 'status', $value);
            }
        );

        $this->crud->addFilter(
            [
                'type' => 'dropdown',
                'name' => 'payment_status',
                'label' => "付款狀態",
            ],
            function () {
                return [
                    -1 => "All",
                    UNPAID => "未付款",
                    PAID => "已付款",
                    REFUNDING => "退款中",
                    REFUNDED => "已退款"];
            },
            function ($value) {
                if($value >=0)
                $this->crud->addClause('where', 'payment_status', $value);
            }
        );

        $this->crud->addColumn([
            "name" => "order_id",
            "type" => "order_name",
            "label" => trans("backpack::site.order_number")
        ]);

        $this->crud->addColumn([
            "name" => "created_at",
            "type" => "datetime",
            "label" => "訂購時間"
        ]);

        $this->crud->addColumn([
            "name" => "email",
            "type" => "email",
            "label" => trans("backpack::site.email")
        ]);


        $this->crud->addColumn([
            "name" => "shipping_items",
            "type" => "shipping_items",
            "label" => trans("backpack::site.shipping_items")
        ]);

        $this->crud->addColumn([
            "name" => "total_amount",
            "type" => "number",
            "label" => trans("backpack::site.total_amount"),
            "prefix" => "NT$"
        ]);

        $this->crud->addColumn([
            'name' => 'payment_method',
            'label' => trans("backpack::site.transaction_payment_type"),
            'type' => "select_from_array",
            "options" => [
                "ecpay" => "信用卡付款",
                "cod" => "現場付款",
            ]
        ]);

        $this->crud->addColumn([
            'name' => 'payment_status',
            'label' => trans("backpack::site.payment_status"),
            'type' => "select_from_array",
            "options" => [
                UNPAID => "未付款",
                PAID => "已付款",
                REFUNDING => "退款中",
                REFUNDED => "已退款",
            ]
        ]);

        $this->crud->addColumn([
            'name' => 'payment_date',
            'label' => trans("backpack::site.transaction_payment_date"),
            'type' => "datetime"
        ]);

        $this->crud->addColumn([
            "name" => "delivery",
            "type" => "select_from_array",
            "options" => [
              "flat_rate" => __("Flat rate"),
              "free_shipping" => __("Free Shipping") ,
              "pickup" =>  __("Local Pickup")
            ],
            "label" => trans("backpack::site.shipping_method")
        ]);


        $this->crud->addColumn([
            "name" => "shipping_info",
            "type" => "shipping_info",
            "label" => trans("backpack::site.shipping_info")
        ]);

        $this->crud->addColumn([
            "name" => "status",
            "type" => "select_from_array",
            "options" => [
                PROCESSING => "處理中",
                COMPLETED => "已完成",
                CANCELED => "已取消"],
            "label" => trans("backpack::site.status")
        ]);

        $this->crud->addColumn([
            "name" => "delivery_status",
            "type" => "select_from_array",
            "options" => [
                WAITING => "待出貨",
                DELIVERING => " 運送中",
                DELIVERED => " 已送達"],
            "label" => "運送狀態"
        ]);

        $this->crud->addColumn([
            "name" => "notes",
            "type" => "text",
            "label" => trans("backpack::site.notes")
        ]);

        $this->crud->removeButton("create");
        $this->crud->removeButton("show");
        $this->crud->removeButton("delete");
        $this->crud->removeButton("update");
        $this->crud->enableExportButtons();
        $this->crud->enableFilters();
        //$this->crud->enableBulkActions();

        $this->crud->orderBy("id", "DESC");
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(OrderRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();

        $this->crud->addField([
            'type' => 'order_info',
            "name" => 'order_id'
        ]);

        $this->crud->addField([
            "name" => "status",
            "type" => "select_from_array",
            "options" => [
                PROCESSING => "處理中",
                COMPLETED => "已完成",
                CANCELED => "已取消"],
            "label" => "訂單狀態"
        ]);

        $this->crud->addField([
            'name' => 'payment_status',
            'label' => "付款狀態",
            'type' => "select_from_array",
            "options" => [
                UNPAID => "未付款",
                PAID => "已付款",
                REFUNDING => "退款中",
                REFUNDED => "已退款",
            ]
        ]);

        $this->crud->addField([
            "name" => "delivery_status",
            "type" => "select_from_array",
            "options" => [
                WAITING => "待出貨",
                DELIVERING => " 運送中",
                DELIVERED => " 已送達"],
            "label" => "運送狀態"
        ]);

        $this->crud->addField([
            "name" => "notes",
            "type" => "textarea",
            "label" => trans("backpack::site.notes")
        ]);

        $this->crud->removeButton("show");
    }

    protected function setupUpdateOperation()
    {

        if($this->crud->getRequest()->isMethod("put")){


            $currentOrder = $this->crud->getEntry($this->crud->getCurrentEntryId());


            if($currentOrder->user){
                $currentOrder->user->is_vip = $currentOrder->user->consume >= 4000;
                $currentOrder->user->save();
            }

            //Reward point
            $payment_status = $this->crud->getRequest()->input("payment_status");
            if($payment_status == PAID && $currentOrder->payment_status != PAID){

                $currentOrder->payment_date = now();

                //Reward
                $reward_point = new UserPoint([
                    "user_id" => $currentOrder->user->id,
                    "amount" => $currentOrder->sub_total,
                    "created_at" => now(),
                    "notes" => "消費積分"
                ]);

                $reward_point->save();
                $currentOrder->user->points += $reward_point->amount;

                Log::info("Reward {$reward_point->amount} for user #{$currentOrder->user->id} on #{$currentOrder->order_id}");

                $currentOrder->user->save();
                $currentOrder->save();
            }

        }

        $this->setupCreateOperation();
    }
}
