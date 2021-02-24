<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MessageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MessageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MessageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Message');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/message');
        $this->crud->setEntityNameStrings(trans("backpack::site.message"), trans("backpack::site.messages"));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        /*$this->crud->addColumn([
            'name' => 'customer_ip',
            'type' => 'text',
            'label' => trans("backpack::site.customer_ip")
        ]);*/

        $this->crud->addColumn([
            'name' => 'customer_name',
            'type' => 'text',
            'label' => trans("backpack::site.customer_name")
        ]);

        $this->crud->addColumn([
            'name' => 'customer_email',
            'type' => 'email',
            'label' => trans("backpack::site.customer_email")
        ]);

        $this->crud->addColumn([
            'name' => 'customer_phone',
            'type' => 'phone',
            'label' => trans("backpack::site.customer_phone")
        ]);

        $this->crud->addColumn([
            'name' => 'customer_free_time',
            'type' => 'text',
            'label' => trans("backpack::site.customer_free_time")
        ]);

        $this->crud->addColumn([
            'name' => 'customer_subject',
            'type' => 'text',
            'label' => trans("backpack::site.customer_subject")
        ]);

        $this->crud->addColumn([
            'name' => 'customer_message',
            'type' => 'text',
            'label' => trans("backpack::site.customer_message")
        ]);

        $this->crud->removeButtons(['create', "show", 'update']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(MessageRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
