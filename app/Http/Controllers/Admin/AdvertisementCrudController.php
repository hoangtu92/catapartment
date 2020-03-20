<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdvertisementRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AdvertisementCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AdvertisementCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Advertisement');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/advertisement');
        $this->crud->setEntityNameStrings(trans('backpack::site.advertisement'), trans('backpack::site.advertisements'));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();

        $this->crud->addColumn([
            "name" => "image",
            "type" => "image",
            "label" => trans("backpack::site.image")
        ]);

        $this->crud->addColumn([
            "name" => "url",
            "type" => "text",
            "label" => trans("backpack::site.url")
        ]);

        $this->crud->addColumn([
            "name" => "timing",
            "type" => "number",
            "label" => trans("backpack::site.timing")
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AdvertisementRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();

        $this->crud->addField([
            "name" => "image",
            "type" => "browse",
            "label" => trans("backpack::site.image")
        ]);

        $this->crud->addField([
            "name" => "url",
            "type" => "text",
            "label" => trans("backpack::site.url")
        ]);

        $this->crud->addField([
            "name" => "timing",
            "type" => "number",
            "label" => trans("backpack::site.timing")
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
