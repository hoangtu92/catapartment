<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FaqRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FaqCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FaqCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Faq');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/faq');
        $this->crud->setEntityNameStrings(trans('faq'), trans('faqs'));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumn([
            "name" => "question",
            "type" => "text",
            "label" => trans("backpack::site.question")
        ]);
        $this->crud->addColumn([
            "name" => "answer",
            "type" => "text",
            "label" => trans("backpack::site.answer")
        ]);

        $this->crud->addColumn([
            "name" => "type",
            "type" => "text",
            "label" => trans("backpack::site.faq_type")
        ]);

        $this->crud->removeButton("show");
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(FaqRequest::class);

        // TODO: remove setFromDb() and manually define Fields

        $this->crud->addField([
            "name" => "question",
            "type" => "text",
            "label" => trans("backpack::site.question")
        ]);

        $this->crud->addField([
            "name" => "answer",
            "type" => "wysiwyg",
            "label" => trans("backpack::site.answer")
        ]);

        $this->crud->addField([
            "name" => "type",
            "type" => "select2_from_array",
            "options" => ["SHIPPING", "PAYMENT"],
            "label" => trans("backpack::site.faq_type")
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
