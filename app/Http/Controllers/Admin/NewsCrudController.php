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
        $this->crud->setEntityNameStrings('news', 'news');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();

        $this->crud->removeColumn("content");

        $this->crud->modifyColumn("image", [
            'type' => 'image'
        ]);

        $this->crud->modifyColumn("author_id", [
            'type' => 'model_function',
            "function_name" => "getAuthorName"
        ]);

        $this->crud->addColumn([
            "name" => "tags",
            "label" => "Tags",
            "type" => "select_multiple",
            "entity" => "tags",
            "attribute" => "name",
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(NewsRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();

        $this->crud->removeField("author_id");

        $this->crud->addField([
            "label" => "Tags",
            "name" => "tags",
            "type" => "select2_multiple",
            "entity" => "tags",
            "attribute" => "name",
            "pivot" => true
        ]);

        $this->crud->modifyField("content", [
            "type" => "wysiwyg"
        ]);

        $this->crud->modifyField("image", [
            "type" => "browse",
            "label" => "Upload Image"
        ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
