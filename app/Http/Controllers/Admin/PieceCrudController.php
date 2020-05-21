<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PieceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PieceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PieceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Piece');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/piece');
        $this->crud->setEntityNameStrings(trans('backpack::site.product_pieces'), trans('backpack::site.product_pieces'));
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            "name" => "name",
            "type" => "text",
            "label" => "Name"
        ]);

        $this->crud->removeButton("show");
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PieceRequest::class);

        $this->crud->addField([
            "name" => "name",
            "type" => "text",
            "label" => "Name"
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
