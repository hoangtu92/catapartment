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
        $this->crud->setEntityNameStrings('product_category', 'product_categories');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();

        $this->crud->modifyColumn("icon", [
            "type" => "image"
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProductCategoryRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();

        $this->crud->modifyField("icon", [
            "type" => "browse"
        ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
