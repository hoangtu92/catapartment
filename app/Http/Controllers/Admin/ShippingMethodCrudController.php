<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ShippingMethodRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ShippingMethodCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ShippingMethodCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ShippingMethod');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/shipping-method');
        $this->crud->setEntityNameStrings(trans("backpack::site.shipping_method"), trans("backpack::site.shipping_method"));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn([
            "name" => "name",
            "type" => "text",
            "label" => trans("backpack::site.shipping_method")
        ]);

        $this->crud->addColumn([
            "name" => "description",
            "type" => "wysiwyg",
            "label" => trans("backpack::site.shipping_method_description")
        ]);

        /*$this->crud->addColumn([
            "name" => "fee",
            "type" => "number",
            "label" => trans("backpack::site.shipping_method_fee")
        ]);*/

        $this->crud->removeButton("show");
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ShippingMethodRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        $this->crud->addField([
            "name" => "name",
            "type" => "text",
            "label" => trans("backpack::site.shipping_method")
        ]);

        $this->crud->addField([
            "name" => "description",
            "type" => "wysiwyg",
            "label" => trans("backpack::site.shipping_method_description")
        ]);

        /*$this->crud->addField([
            "name" => "fee",
            "type" => "number",
            "label" => trans("backpack::site.shipping_method_fee")
        ]);*/
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
