<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings(trans("backpack::site.user"), trans("backpack::site.users"));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumn([
            'name' => 'username',
            'label' => trans("backpack::site.username"),
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'name',
            'label' => trans("backpack::site.name"),
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'email',
            'label' => trans("backpack::site.email"),
            'type' => 'email'
        ]);

        $this->crud->addColumn([
            'name' => 'phone',
            'label' => trans("backpack::site.phone"),
            'type' => 'phone'
        ]);

        $this->crud->addColumn([
            'name' => 'role',
            'label' => trans("backpack::site.role"),
            'type' => 'text'
        ]);

        $this->crud->removeButton("show");

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(UserRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addField([
            'name' => 'username',
            'label' => trans("backpack::site.username"),
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'name',
            'label' => trans("backpack::site.name"),
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'email',
            'label' => trans("backpack::site.email"),
            'type' => 'email'
        ]);

        $this->crud->addField([
            'name' => 'phone',
            'label' => trans("backpack::site.phone"),
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'role',
            'label' => trans("backpack::site.role"),
            'type' => 'select_from_array',
            "options" => array("user", "admin")
        ]);

        $this->crud->addField([
            'name' => 'password',
            'label' => trans("backpack::site.password"),
            'type' => 'password'
        ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
