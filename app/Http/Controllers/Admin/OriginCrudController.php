<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OriginRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OriginCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OriginCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Origin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/origin');
        $this->crud->setEntityNameStrings(trans('backpack::site.product_origin'), trans('backpack::site.product_origin'));
    }


    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn([
            "name" => "icon",
            "type" => "image",
            "label" => "Icon"
        ]);
        $this->crud->addColumn([
            "name" => "name",
            "type" => "text",
            "label" => "Name"
        ]);

        $this->crud->removeButton("show");
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(OriginRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        $this->crud->addField([
            "name" => "icon",
            "type" => "browse",
            "label" => "Icon"
        ]);
        $this->crud->addField([
            "name" => "name",
            "type" => "text",
            "label" => "Name"
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
