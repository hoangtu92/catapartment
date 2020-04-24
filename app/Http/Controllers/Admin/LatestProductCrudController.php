<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LatestProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LatestProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LatestProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\LatestProduct');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/latest-product');
        $this->crud->setEntityNameStrings(trans("backpack::site.latest-product"), trans("backpack::site.latest-products"));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn([
            'name' => 'product_id',
            "entity" => "product",
            "attribute" => "name",
            'label' => trans("backpack::site.product"),
            'type' => 'select'
        ]);

        $this->crud->addColumn([
            'name' => 'display',
            'label' => trans("backpack::site.display"),
            'type' => 'item_visibility'
        ]);

        if($this->crud->count() >= 5){
            $this->crud->removeButton("create");
            $this->crud->addButtonFromView("top", "warning", "warning");
        }

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(LatestProductRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        $this->crud->addField([
            "name" => "product_id",
            "type" => "select2",
            "entity" => "product",
            "attribute" => "name",
            "label" => trans("backpack::site.product")
        ]);


        $this->crud->addField([
            'name' => 'display',
            "label" => trans('backpack::site.display'),
            'type' => 'checkbox',
            'wrapperAttributes' => [
                'id' => "item_display"
            ]
        ]);

        $this->crud->addField([
            'name' => 'valid_from',
            "label" => trans('backpack::site.valid_from'),
            'type' => 'date_picker',
            'wrapperAttributes' => [
                'id' => "valid_from"
            ]
        ]);

        $this->crud->addField([
            'name' => 'valid_until',
            "label" => trans('backpack::site.valid_until'),
            'type' => 'date_picker',
            'wrapperAttributes' => [
                'id' => "valid_until"
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'productName');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 1);
    }
}
