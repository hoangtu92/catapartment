<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RecommendProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RecommendProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RecommendProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\RecommendProduct');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/recommend-product');
        $this->crud->setEntityNameStrings(trans("backpack::site.recommend-product"), trans("backpack::site.recommend-products"));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();

        $this->crud->orderBy("lft", "ASC");

        $this->crud->addColumn([
            'name' => "lft",
            'type' => 'number',
            'label' => '位置'
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
           'name' => "category",
           'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'display',
            'label' => trans("backpack::site.display"),
            'type' => 'item_visibility'
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(RecommendProductRequest::class);

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
            'name' => "category",
            'type' => 'select2_from_array',
            'options' => ["熱賣拼圖", "新品預購", "換季促銷"]
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
