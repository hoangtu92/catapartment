<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Product');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/product');
        $this->crud->setEntityNameStrings(trans('backpack::site.product'), trans('backpack::site.products'));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();

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

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProductRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        $this->crud->addField([
            "name" => "category_id",
            "type" => "select2",
            "entity" => "category",
            "attribute" => "name",
            "label" => trans("backpack::site.product_category")
        ]);
        $this->crud->addField([
            "name" => "name",
            "type" => "text",
            "label" => trans("backpack::site.product_name")
        ]);
        $this->crud->addField([
            "name" => "slug",
            "type" => "text",
            "label" => trans("backpack::site.product_slug")
        ]);
        $this->crud->addField([
            "name" => "price",
            "type" => "number",
            "label" => trans("backpack::site.product_price")
        ]);

        $this->crud->addField([
            "name" => "sale_price",
            "type" => "number",
            "label" => trans("backpack::site.product_sale_price")
        ]);

        $this->crud->addField([
            "name" => "image",
            "type" => "browse",
            "label" => trans("backpack::site.product_image")
        ]);

        $this->crud->removeButton("show");
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
