<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TransactionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TransactionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TransactionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Transaction');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/transaction');
        $this->crud->setEntityNameStrings(trans('backpack::site.transaction'), trans('backpack::site.transactions'));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn([
            'name' => 'order_id',
            'label' => trans("backpack::site.transaction_order"),
            'type' => "text"
        ]);

        $this->crud->addColumn([
            'name' => 'amount',
            'label' => trans("backpack::site.transaction_amount"),
            'type' => "number"
        ]);

        $this->crud->addColumn([
            'name' => 'payment_no',
            'label' => trans("backpack::site.transaction_payment_no"),
            'type' => "text"
        ]);

        $this->crud->addColumn([
            'name' => 'payment_type',
            'label' => trans("backpack::site.transaction_payment_type"),
            'type' => "text"
        ]);

        $this->crud->addColumn([
            'name' => 'payment_date',
            'label' => trans("backpack::site.transaction_payment_date"),
            'type' => "datetime"
        ]);

        $this->crud->removeButtons(["show"]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TransactionRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        $this->crud->addField([
            'name' => 'order_id',
            'label' => trans("backpack::site.transaction_order"),
            'type' => "select2",
            'entity' => 'order',
            'attribute' => 'order_id'
        ]);

        $this->crud->addField([
            'name' => 'amount',
            'label' => trans("backpack::site.transaction_amount"),
            'type' => "number"
        ]);


        $this->crud->addField([
            'name' => 'payment_type',
            'label' => trans("backpack::site.transaction_payment_type"),
            'type' => "text"
        ]);

        $this->crud->addField([
            'name' => 'payment_date',
            'label' => trans("backpack::site.transaction_payment_date"),
            'type' => "datetime"
        ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
