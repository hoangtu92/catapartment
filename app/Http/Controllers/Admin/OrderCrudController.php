<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
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

        $this->crud->addColumn([
            "name" => "order_id",
            "type" => "text",
            "label" => trans("backpack::site.order_number")
        ]);


        $this->crud->addColumn([
            "name" => "shipping_items",
            "type" => "shipping_items",
            "label" => trans("backpack::site.shipping_items")
        ]);

        $this->crud->addColumn([
            "name" => "total_amount",
            "type" => "text",
            "label" => trans("backpack::site.total_amount"),
            "prefix" => "TWD "
        ]);

        $this->crud->addColumn([
            "name" => "delivery",
            "type" => "text",
            "label" => trans("backpack::site.delivery")
        ]);


        /*$this->crud->addColumn([
            "name" => "payment_type",
            "type" => "text",
            "label" => trans("backpack::site.payment_type")
        ]);

        $this->crud->addColumn([
            "name" => "payment_date",
            "type" => "datetime",
            "label" => trans("backpack::site.payment_date")
        ]);*/

        $this->crud->addColumn([
            "name" => "shipping_info",
            "type" => "shipping_info",
            "label" => trans("backpack::site.shipping_info")
        ]);

        $this->crud->addColumn([
            "name" => "status",
            "type" => "text",
            "label" => trans("backpack::site.status")
        ]);

        $this->crud->addColumn([
            "name" => "notes",
            "type" => "text",
            "label" => trans("backpack::site.notes")
        ]);

        $this->crud->removeButton("create");

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(OrderRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();

        $this->crud->addField([
            "name" => "status",
            "type" => "select_from_array",
            "options" => [PENDING, PROCESSING, COMPLETED],
            "label" => trans("backpack::site.status")
        ]);

        $this->crud->addField([
            "name" => "notes",
            "type" => "wysiwyg",
            "label" => trans("backpack::site.notes")
        ]);

        $this->crud->removeButton("show");
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
