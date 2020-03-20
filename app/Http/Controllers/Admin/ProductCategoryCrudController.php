<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductCategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ProductCategory');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/product-category');
        $this->crud->setEntityNameStrings(trans('backpack::site.product_category'), trans('backpack::site.product_category'));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumn([
            "name" => "name",
            "type" => "text",
            "label" => trans('backpack::site.category_name')
        ]);

        $this->crud->addColumn([
            "name" => "icon",
            "type" => "image",
            "label" => trans('backpack::site.category_icon')
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProductCategoryRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addField([
            "name" => "name",
            "type" => "text",
            "label" => trans('backpack::site.category_name')
        ]);

        $this->crud->addField([
            "name" => "icon",
            "type" => "browse",
            "label" => trans('backpack::site.category_icon')
        ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
