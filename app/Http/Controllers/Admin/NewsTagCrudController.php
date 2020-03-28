<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsTagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NewsTagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NewsTagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\NewsTag');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/news-tag');
        $this->crud->setEntityNameStrings(trans('backpack::site.news_tag'), trans('backpack::site.news_tags'));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumn([
           "name" => "name",
           "type" => "text",
           "label" => trans('backpack::site.tag_name')
        ]);

        $this->crud->removeButton("show");
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(NewsTagRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addField([
            "name" => "name",
            "type" => "text",
            "label" => trans('backpack::site.tag_name')
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
