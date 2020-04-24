<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SlideRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class SlideCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SlideCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Slide');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/slide');
        $this->crud->setEntityNameStrings(trans('backpack::site.slide'), trans('backpack::site.slide'));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumn([
            'name' => 'title',
            "label" => trans('backpack::site.slide_title'),
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'link',
            "label" => trans('backpack::site.slide_link'),
            'type' => 'url'
        ]);

        $this->crud->addColumn([
            'name' => 'image',
            "label" => trans('backpack::site.slide_image'),
            'type' => 'image'
        ]);

        $this->crud->addColumn([
            'name' => 'display',
            'label' => trans("backpack::site.display"),
            'type' => 'item_visibility'
        ]);

        $this->crud->removeButton("show");

        if($this->crud->count() >= 7){
            $this->crud->removeButton("create");
            $this->crud->addButtonFromView("top", "warning", "warning");
        }
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(SlideRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addField([
            'name' => 'title',
            "label" => trans('backpack::site.slide_title'),
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'link',
            "label" => trans('backpack::site.slide_link'),
            'type' => 'url'
        ]);

        $this->crud->addField([
            'name' => 'image',
            "label" => trans('backpack::site.upload_image') . " <span>(1200x567)</span>",
            'type' => 'browse'
        ]);

        $this->crud->addField([
            'name' => 'display',
            "label" => trans('backpack::site.display'),
            'type' => 'checkbox'
        ]);

        $this->crud->addField([
            'name' => 'display',
            "label" => trans('backpack::site.display'),
            'type' => 'checkbox',
            'wrapperAttributes' => [
                'id' => "item_display"
            ]
        ]);

        $this->crud->addField([
            'name' => 'valid_from',
            "label" => trans('backpack::site.valid_from'),
            'type' => 'date_picker',
            'wrapperAttributes' => [
                'id' => "valid_from"
            ]
        ]);

        $this->crud->addField([
            'name' => 'valid_until',
            "label" => trans('backpack::site.valid_until'),
            'type' => 'date_picker',
            'wrapperAttributes' => [
                'id' => "valid_until"
            ]
        ]);




    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

}
