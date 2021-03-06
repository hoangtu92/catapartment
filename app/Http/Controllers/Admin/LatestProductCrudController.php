<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LatestProductRequest;
use App\Models\LatestProduct;
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

    //use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

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

        $this->crud->orderBy("lft", "ASC");

        $this->crud->addColumn([
            'name' => "lft",
            'type' => 'select_from_array',
            'label' => '位置',
            'options' => [
                0 => "",
                1 => "主圖",
                2 => "左上",
                3 => "右上",
                4 => "左下",
                5 => "右下",
            ]
        ]);

        $this->crud->addColumn([
            'name' => 'image',
            'label' => trans("backpack::site.product_image"),
            'type' => 'product_relation_image'
        ]);

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

        $this->crud->removeButton("show");
        $this->crud->removeButton("create");

        /*if($this->crud->count() >= 5){
            $this->crud->removeButton("create");
            $this->crud->addButtonFromView("top", "warning", "warning");
        }*/

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(LatestProductRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();

        $latestProducts = LatestProduct::all();
        $compare = [];

        foreach($latestProducts as $latestProduct){
            $compare[] = $latestProduct->lft;
        }

        $this->crud->addField([
            'name' => 'lft',
            'label' => '位置',
            'type' => 'select2_from_array_custom',
            'compare' => $compare,
            'options' => [
                1 => "主圖",
                2 => "左上",
                3 => "右上",
                4 => "左下",
                5 => "右下",
            ]

        ]);

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

    /*protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'productName');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 1);
    }*/
}
