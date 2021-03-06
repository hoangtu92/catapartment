<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsletterRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class NewsletterCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NewsletterCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Newsletter');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/newsletter');
        $this->crud->setEntityNameStrings(trans('backpack::site.newsletter'), trans('backpack::site.newsletter'));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn([
            'name' => 'email',
            'type' => 'email',
            'label' => trans("backpack::site.email")
        ]);


        //$this->crud->removeButton("create");
        $this->crud->removeButton("show");
        $this->crud->enableExportButtons();

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(NewsletterRequest::class);

        // TODO: remove setFromDb() and manually define Fields
       //$this->crud->setFromDb();


        $this->crud->addField([
            'name' => 'email',
            'type' => 'email',
            'label' => trans("backpack::site.email")
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
