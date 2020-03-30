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
            "name" => "type",
            "type" => "text",
            "label" => trans("backpack::site.ads_type")
        ]);


        $this->crud->addColumn([
            'name' => 'display',
            'format' => 'j, M Y',
            'label' => trans("backpack::site.display"),
            'type' => 'item_visibility'
        ]);

        $this->crud->removeButton("show");
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AdvertisementRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();

        $this->crud->addField([
            "name" => "type",
            "type" => "ads_type",
            "label" => trans("backpack::site.ads_type"),
            "id" => "ads_type"
        ]);

        $this->crud->addField([
            "name" => "code",
            "type" => "code",
            "label" => trans("backpack::site.google_ads")
        ]);

        $this->crud->addField([
            "name" => "image",
            "type" => "browse",
            "wrapperAttributes" => [
                "id" => "ads_image"
            ],
            "label" => trans("backpack::site.image")." <span>(1920x440)</span>"
        ]);

        $this->crud->addField([
            "name" => "url",
            "type" => "url",
            "wrapperAttributes" => [
                "id" => "ads_url"
            ],
            "label" => trans("backpack::site.url")
        ]);

        $this->crud->addField([
            'name' => 'display',
            "label" => trans('backpack::site.display'),
            'type' => 'checkbox',
            'wrapper_attributes' => [
                'id' => "item_display"
            ]
        ]);

        $this->crud->addField([
            'name' => 'valid_from',
            "label" => trans('backpack::site.valid_from'),
            'type' => 'date_picker',
            'wrapper_attributes' => [
                'id' => "valid_from"
            ]
        ]);

        $this->crud->addField([
            'name' => 'valid_until',
            "label" => trans('backpack::site.valid_until'),
            'type' => 'date_picker',
            'wrapper_attributes' => [
                'id' => "valid_until"
            ]
        ]);


    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
