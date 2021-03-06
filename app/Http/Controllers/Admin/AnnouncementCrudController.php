<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AnnouncementRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AnnouncementCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AnnouncementCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Announcement');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/announcement');
        $this->crud->setEntityNameStrings(trans('backpack::site.announcement'), trans('backpack::site.announcements'));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn([
            "name" => "content",
            "type" => "text",
            "label" => trans("backpack::site.announcement_content")
        ]);
        $this->crud->addColumn([
            "name" => "url",
            "type" => "url",
            "label" => trans("backpack::site.url")
        ]);

        $this->crud->addColumn([
            "name" => "timing",
            "type" => "number",
            "label" => trans("backpack::site.timing")
        ]);

        $this->crud->addColumn([
            'name' => 'display',
            'label' => trans("backpack::site.display"),
            'type' => 'item_visibility'
        ]);

        $this->crud->removeButton("show");

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AnnouncementRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addField([
            "name" => "content",
            "type" => "text",
            "label" => trans("backpack::site.announcement_content")
        ]);
        $this->crud->addField([
            "name" => "url",
            "type" => "url",
            "label" => trans("backpack::site.url")
        ]);

        $this->crud->addField([
            "name" => "timing",
            "type" => "number",
            "label" => trans("backpack::site.timing")
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
