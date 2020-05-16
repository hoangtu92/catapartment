<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Page');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/page');
        $this->crud->setEntityNameStrings(trans("backpack::site.page") , trans("backpack::site.page"));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
       // $this->crud->setFromDb();
        $this->crud->addColumn([
           'name' => 'title',
           'type' => "link",
           "label" => trans("backpack::site.page_title")
        ]);

        /*$this->crud->addColumn([
            'name' => 'slug',
            'type' => "text",
            "label" => trans("backpack::site.page_slug")
        ]);*/
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PageRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        $this->crud->addField([
            'name' => 'title',
            'type' => "text",
            "label" => trans("backpack::site.page_title")
        ]);


        $this->crud->addField([
            'name' => 'slug',
            'type' => "page_slug",
            "label" => trans("backpack::site.page_slug")
        ]);



        $this->crud->addField([
            'name' => 'content',
            'type' => "wysiwyg",
            "label" => trans("backpack::site.page_content")
        ]);

        $this->crud->addField([
            'name' => 'display',
            'type' => "checkbox",
            "label" => trans("backpack::site.page_display")
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
