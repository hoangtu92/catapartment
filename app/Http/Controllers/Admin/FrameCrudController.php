<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FrameRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FrameCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FrameCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Product');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/frame');
        $this->crud->setEntityNameStrings('框的材質', '框的材質');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();

        $this->crud->addClause("where", "type", "=", FRAME);

        $this->crud->addColumn([
            "name" => "image",
            "type" => "image",
            "label" => trans("backpack::site.product_image")
        ]);

        $this->crud->addColumn([
           "name" => "sku",
           "label" => "貨號",
           "type" => "text"
        ]);

        $this->crud->addColumn([
            "name" => "name",
            "label" => "框的名稱",
            "type" => "text"
        ]);

        $this->crud->addColumn([
            "name" => "price",
            "label" => "價格",
            "type" => "number"
        ]);
        $this->crud->addColumn([
            "name" => "sale_price",
            "label" => "特價",
            "type" => "number"
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(FrameRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();

        $this->crud->addField([
            "name" => "type",
            "type" => "select_from_array",
            "options" => [FRAME => FRAME],
            "value" => FRAME,
            "attributes" => [
                "readonly" => true,
                "class" => "hide"
            ],
            "wrapperAttributes" => [
                "style" => "display: none"
            ]
        ]);

        $this->crud->addField([
            "name" => "name",
            "label" => "框的名稱",
            "type" => "text"
        ]);

        $this->crud->addField([
            "name" => "sku",
            "label" => "貨號",
            "type" => "text"
        ]);

        $this->crud->addField([
            "name" => "stock",
            "type" => "number",
            "label" => "庫存"
        ]);

        $this->crud->addField([
            "name" => "image",
            "type" => "browse",
            "label" => "主圖"
        ]);

        $this->crud->addField([
            "name" => "images",
            "type" => "browse_multiple",
            "label" => "圖片"
        ]);

        $this->crud->addField([
            "name" => "price",
            "label" => "價格",
            "type" => "number"
        ]);
        $this->crud->addField([
            "name" => "sale_price",
            "label" => "特價",
            "type" => "number"
        ]);

        $this->crud->addField([
            "name" => "short_description",
            "type" => "summernote",
            "label" => "商品簡介"
        ]);

        $this->crud->addField([
            "name" => "content",
            "type" => "wysiwyg",
            "label" => "商品詳細簡介"
        ]);


        $this->crud->removeButton("show");
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation(){
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumn([
            'name' => 'name',
            'label' => trans("backpack::site.product_name"),
            'type' => "text"
        ]);

        $this->crud->addColumn([
            "name" => "keywords",
            "type" => "textarea",
            "label" => trans("backpack::site.product_keywords")
        ]);

        /*$this->crud->addColumn([
            "name" => "category_id",
            "type" => "select",
            "entity" => "category",
            "attribute" => "name",
            "label" => trans("backpack::site.product_category")
        ]);*/

        $this->crud->addColumn([
            "name" => "sku",
            "type" => "text",
            "label" => trans("backpack::site.product_sku")
        ]);

        /*$this->crud->addColumn([
            "name" => "slug",
            "type" => "text",
            "label" => trans("backpack::site.product_slug")
        ]);*/

        $this->crud->addColumn([
            "name" => "barcode",
            "type" => "text",
            "label" => trans("backpack::site.product_barcode")
        ]);

        $this->crud->addColumn([
            "name" => "status",
            "type" => "product_status",
            "label" => trans("backpack::site.product_status"),
            "id" => "product_status"

        ]);

        $this->crud->addColumn([
            "name" => "stock",
            "type" => "number",
            "wrapperAttributes" => [
                "id" => "stock_field"
            ],
            "label" => trans("backpack::site.product_stock")
        ]);

        $this->crud->addColumn([
            "name" => "price",
            "type" => "number",
            "label" => trans("backpack::site.product_price")
        ]);

        $this->crud->addColumn([
            "name" => "sale_price",
            "type" => "number",
            "label" => trans("backpack::site.product_sale_price")
        ]);

        $this->crud->addColumn([
            "name" => "measures",
            "type" => "text",
            "label" => trans("backpack::site.product_measures")
        ]);

        $this->crud->addColumn([
            "name" => "origin_id",
            "type" => "select",
            "entity" => "origin",
            "attribute" => "name",
            "label" => trans("backpack::site.product_origin")
        ]);

        $this->crud->addColumn([
            "name" => "piece_id",
            "type" => "select",
            "entity" => "piece",
            "attribute" => "name",
            "label" => trans("backpack::site.product_pieces")
        ]);

        $this->crud->addColumn([
            "name" => "brand_id",
            "type" => "select",
            "entity" => "brand",
            "attribute" => "name",
            "label" => trans("backpack::site.product_brand")
        ]);
        $this->crud->addColumn([
            "name" => "colors",
            "type" => "select_multiple",
            "entity" => "colors",
            "attribute" => "name",
            "label" => trans("backpack::site.product_color"),
            "pivot" => true
        ]);

        $this->crud->addColumn([
            "name" => "shipping_methods",
            "type" => "select_multiple",
            "entity" => "shipping_methods",
            "attribute" => "name",
            "label" => trans("backpack::site.shipping_method"),
            "pivot" => true
        ]);

        $this->crud->addColumn([
            "name" => "image",
            "type" => "image",
            "label" => trans("backpack::site.product_image")
        ]);

        $this->crud->addColumn([
            "name" => "images",
            "type" => "images",
            "label" => trans("backpack::site.product_slide")
        ]);

        $this->crud->addColumn([
            "name" => "short_description",
            "type" => "text",
            "label" => trans("backpack::site.product_description")
        ]);

        $this->crud->addColumn([
            "name" => "content",
            "type" => "text",
            "label" => trans("backpack::site.product_content")
        ]);

    }
}
