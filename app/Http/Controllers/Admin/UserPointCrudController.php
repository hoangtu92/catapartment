<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserPointRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserPointCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserPointCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\UserPoint');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user-point');
        $this->crud->setEntityNameStrings(trans("backpack::site.user_point"), trans("backpack::site.user_point"));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn([
            'name' => 'user_id',
            'type' => 'select',
            'entity' => 'user',
            'attribute' => 'username',
            'label' => trans("backpack::site.user")
        ]);

        $this->crud->addColumn([
            'name' => 'amount',
            'type' => 'number',
            'label' => trans("backpack::site.point_amount")
        ]);

        $this->crud->addColumn([
            'name' => 'notes',
            'type' => 'text',
            'label' => trans("backpack::site.notes")
        ]);

        $this->crud->removeButtons(["show", "create", "edit"]);
        $this->crud->enableExportButtons();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(UserPointRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        $this->crud->addField([
            'name' => 'user_id',
            'type' => 'select2',
            'entity' => 'user',
            'attribute' => 'username',
            'label' => trans("backpack::site.user")
        ]);

        $this->crud->addField([
            'name' => 'amount',
            'type' => 'number',
            'label' => trans("backpack::site.point_amount")
        ]);

        $this->crud->addField([
            'name' => 'notes',
            'type' => 'wysiwyg',
            'label' => trans("backpack::site.notes")
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
