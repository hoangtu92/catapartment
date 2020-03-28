<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class NewsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NewsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\News');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/news');
        $this->crud->setEntityNameStrings(trans('backpack::site.news'), trans('backpack::site.news'));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters


        $this->crud->addColumn([
            "name" => "title",
            'type' => 'text',
            "label" => trans("backpack::site.news_title")
        ]);

        $this->crud->addColumn([
            "name" => "author_id",
            'type' => 'model_function',
            "function_name" => "getAuthorName",
            "label" => trans("backpack::site.author")
        ]);

        $this->crud->addColumn([
            "name" => "image",
            'type' => 'image',
            "label" => trans("backpack::site.image")
        ]);

        $this->crud->addColumn([
            "name" => "tags",
            "type" => "select_multiple",
            "entity" => "tags",
            "attribute" => "name",
            "label" => trans("backpack::site.tags")
        ]);

        $this->crud->removeButton("show");
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(NewsRequest::class);

        // TODO: remove setFromDb() and manually define Fields

        $this->crud->addField([
            "name" => "title",
            "type" => "text",
            "label" => trans("backpack::site.news_title")
        ]);

        $this->crud->addField([
            "name" => "tags",
            "type" => "select2_multiple",
            "entity" => "tags",
            "attribute" => "name",
            "pivot" => true,
            "label" => trans("backpack::site.tags")
        ]);

        $this->crud->addField([
            "name" => "content",
            "type" => "wysiwyg",
            "label" => trans("backpack::site.news_content")
        ]);

        $this->crud->addField([
            "name" => "image",
            "type" => "browse",
            "label" => trans("backpack::site.upload_image")
        ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
