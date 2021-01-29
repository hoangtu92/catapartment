<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\StockNotifyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StockNotifyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StockNotifyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\StockNotify');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/stock-notify');
        $this->crud->setEntityNameStrings('補貨通知名單', '補貨通知名單');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();

        $this->crud->addColumn([
           "name" => "name" ,
            "type" => "text",
            "label" => "名稱"
        ]);

        $this->crud->addColumn([
            "name" => "email" ,
            "type" => "email",
            "label" => "Email"
        ]);

        $this->crud->addColumn([
           "name" => "phone" ,
            "type" => "phone",
            "label" => "電話"
        ]);

        $this->crud->addColumn([
            "name" => "product_id" ,
            "type" => "product",
            "entity" => "product",
            "attribute" => "name",
            "label" => "通知商品"
        ]);

        $this->crud->removeButtons(["create", "show", "update"]);


    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProductRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumn([
            "name" => "name" ,
            "type" => "text",
            "label" => "名稱"
        ]);

        $this->crud->addColumn([
            "name" => "email" ,
            "type" => "email",
            "label" => "Email"
        ]);

        $this->crud->addColumn([
            "name" => "phone" ,
            "type" => "phone",
            "label" => "電話"
        ]);

        $this->crud->addColumn([
            "name" => "product_id" ,
            "type" => "product",
            "entity" => "product",
            "attribute" => "name",
            "label" => "通知商品"
        ]);
    }
}
