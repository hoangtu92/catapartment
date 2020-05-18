<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubMenuRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SubMenuCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SubMenuCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\SubMenu');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/submenu');
        $this->crud->setEntityNameStrings(trans("backpack::site.submenu"), trans("backpack::site.submenu"));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn([
           'name' => "title",
           'type' => "text",
           "label" => trans("backpack::site.submenu_title")
        ]);

        $this->crud->addColumn([
            'name' => "date",
            'type' => "date",
            "format" => "YYYY/MM/DD",
            "label" => trans("backpack::site.submenu_date")
        ]);
        $this->crud->removeButton("show");
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(SubMenuRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        $this->crud->addField([
            'name' => "title",
            'type' => "text",
            "label" => trans("backpack::site.submenu_title")
        ]);

        $this->crud->addField([
            'name' => "date",
            'type' => "date_picker",
            "label" => trans("backpack::site.submenu_date")
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
