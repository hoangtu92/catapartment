<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

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
                'type' => 'select2',
                'name' => 'status',
                'label' => trans("backpack::site.status"),
            ],
            function () {
                return [PROCESSING => "處理中",
                    COMPLETED => "已完成",
                    CANCELED => "已取消"];
            },
            function ($value) {
                $this->crud->addClause('where', 'status', $value);
            }
        );

        $this->crud->addFilter(
            [
                'type' => 'select2',
                'name' => 'payment_status',
                'label' => trans("backpack::site.payment_status"),
            ],
            function () {
                return [
                    UNPAID => "未付款",
                    PAID => "已付款",
                    REFUNDING => "退款中",
                    REFUNDED => "已退款"];
            },
            function ($value) {
                $this->crud->addClause('where', 'payment_status', $value);
            }
        );

        $this->crud->addColumn([
            "name" => "order_id",
            "type" => "order_name",
            "label" => trans("backpack::site.order_number")
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
            'name' => 'payment_type',
            'label' => trans("backpack::site.transaction_payment_type"),
            'type' => "select_from_array",
            "options" => [
                "Credit_CreditCard" => "信用卡"
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
            "label" => trans("backpack::site.delivery")
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

        /*$this->crud->addColumn([
            "name" => "delivery_status",
            "type" => "select_from_array",
            "options" => [
                WAITING => "待出貨",
                DELIVERING => " 運送中",
                DELIVERED => " 已送達"],
            "label" => "運送狀態"
        ]);*/

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
        $this->crud->enableBulkActions();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(OrderRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();

        $this->crud->addField([
            "name" => "status",
            "type" => "select_from_array",
            "options" => [
                PROCESSING => "處理中",
                COMPLETED => "已完成",
                CANCELED => "已取消"],
            "label" => trans("backpack::site.status")
        ]);

        $this->crud->addField([
            'name' => 'payment_status',
            'label' => "狀態",
            'type' => "select_from_array",
            "options" => [
                UNPAID => "未付款",
                PAID => "已付款",
                REFUNDING => "退款中",
                REFUNDED => "已退款",
            ]
        ]);

       /* $this->crud->addField([
            "name" => "delivery_status",
            "type" => "select_from_array",
            "options" => [
                WAITING => "待出貨",
                DELIVERING => " 運送中",
                DELIVERED => " 已送達"],
            "label" => "運送狀態"
        ]);*/

        $this->crud->addField([
            "name" => "notes",
            "type" => "wysiwyg",
            "label" => trans("backpack::site.notes")
        ]);

        $this->crud->removeButton("show");
    }

    protected function setupUpdateOperation()
    {

        if($this->crud->request->isMethod("put")){

            $currentOrder = $this->crud->getEntry($this->crud->getCurrentEntryId());
            $shopping_accumulate = 0;

            foreach($currentOrder->user->orders as $order){
                if($order->status != COMPLETED) continue;
                $shopping_accumulate += $order->sub_total;
            }

            $old_state = $currentOrder->user->is_vip;


            if($shopping_accumulate >= 4000){
                $currentOrder->user->is_vip = true;
            }
            else{
                $currentOrder->user->is_vip = false;
            }
            if($old_state != $currentOrder->user->is_vip){
                $currentOrder->user->save();
            }

        }

        $this->setupCreateOperation();
    }
}
