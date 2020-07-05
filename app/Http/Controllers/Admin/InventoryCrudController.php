<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InventoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class InventoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InventoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Product');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/inventory');
        $this->crud->setEntityNameStrings('庫存警示', '庫存警示');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters

        $this->crud->addClause("where", "stock", "=", "0");
        $this->crud->addClause("orWhere", "status", "=", PRE_ORDER);

        $this->crud->addColumn([
            "name" => "image",
            "type" => "image",
            "label" => trans("backpack::site.product_image")
        ]);

        $this->crud->addColumn([
            "name" => "name",
            "type" => "text",
            "label" => trans("backpack::site.product_name")
        ]);
        $this->crud->addColumn([
            "name" => "slug",
            "type" => "text",
            "label" => trans("backpack::site.product_slug")
        ]);
        $this->crud->addColumn([
            "name" => "price",
            "type" => "number",
            "label" => trans("backpack::site.product_price")
        ]);

        $this->crud->addColumn([
            "name" => "sale_price",
            "type" => "number",
            "label" => trans("backpack::site.product_sale_price")
        ]);

        $this->crud->addColumn([
            "name" => "category",
            "type" => "select",
            "entity" => "category",
            "attribute" => "name",
            "label" => trans("backpack::site.product_category")
        ]);

        $this->crud->removeButtons(["create", "update", 'show']);
        $this->crud->addButtonFromView("line", "Edit", "edit_product");
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(InventoryRequest::class);


        $this->crud->removeButton("show");
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
