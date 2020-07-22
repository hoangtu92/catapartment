<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Mail\AdminNotifyInventory;
use App\Mail\InventoryNotify;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Mail;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Product');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/product');
        $this->crud->setEntityNameStrings(trans('backpack::site.product'), trans('backpack::site.products'));
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();

        $this->crud->addClause("where", "type", "=", NORMAL);

        $this->crud->addColumn([
            "name" => "image",
            "type" => "image",
            "label" => trans("backpack::site.product_image")
        ]);

        $this->crud->addColumn([
            "name" => "name",
            "type" => "text",
            "label" => trans("backpack::site.product_name")
        ]);
        $this->crud->addColumn([
            "name" => "slug",
            "type" => "text",
            "label" => trans("backpack::site.product_slug")
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
            "name" => "category",
            "type" => "select",
            "entity" => "category",
            "attribute" => "name",
            "label" => trans("backpack::site.product_category")
        ]);

        //$this->crud->removeButton("show");

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

        $this->crud->addColumn([
            "name" => "category_id",
            "type" => "select",
            "entity" => "category",
            "attribute" => "name",
            "label" => trans("backpack::site.product_category")
        ]);

        $this->crud->addColumn([
            "name" => "sku",
            "type" => "text",
            "label" => trans("backpack::site.product_sku")
        ]);

        $this->crud->addColumn([
            "name" => "slug",
            "type" => "text",
            "label" => trans("backpack::site.product_slug")
        ]);

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
            "type" => "summernote",
            "label" => trans("backpack::site.product_description")
        ]);

        $this->crud->addColumn([
            "name" => "content",
            "type" => "wysiwyg",
            "label" => trans("backpack::site.product_content")
        ]);

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProductRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();

        $this->crud->addField([
            "name" => "type",
            "type" => "select_from_array",
            "options" => [NORMAL => "Product"],
            "attributes" => [
                "readonly" => true
            ]
        ]);

        $this->crud->addField([
            "name" => "name",
            "type" => "text",
            "label" => trans("backpack::site.product_name")
        ]);

        $this->crud->addField([
            "name" => "keywords",
            "type" => "textarea",
            "label" => trans("backpack::site.product_keywords")
        ]);

        $this->crud->addField([
            "name" => "category_id",
            "type" => "select2",
            "entity" => "category",
            "attribute" => "name",
            "label" => trans("backpack::site.product_category")
        ]);

        $this->crud->addField([
            "name" => "sku",
            "type" => "text",
            "label" => trans("backpack::site.product_sku")
        ]);

        $this->crud->addField([
            "name" => "slug",
            "type" => "text",
            "label" => trans("backpack::site.product_slug")
        ]);

        $this->crud->addField([
            "name" => "barcode",
            "type" => "text",
            "label" => trans("backpack::site.product_barcode")
        ]);

        $this->crud->addField([
            "name" => "status",
            "type" => "product_status",
            "label" => trans("backpack::site.product_status"),
            "id" => "product_status"

        ]);

        $this->crud->addField([
            "name" => "stock",
            "type" => "number",
            "wrapperAttributes" => [
                "id" => "stock_field"
            ],
            "label" => trans("backpack::site.product_stock")
        ]);

        $this->crud->addField([
            "name" => "price",
            "type" => "number",
            "label" => trans("backpack::site.product_price")
        ]);

        $this->crud->addField([
            "name" => "sale_price",
            "type" => "number",
            "label" => trans("backpack::site.product_sale_price")
        ]);

        $this->crud->addField([
            "name" => "measures",
            "type" => "text",
            "label" => trans("backpack::site.product_measures")
        ]);

        $this->crud->addField([
            "name" => "origin_id",
            "type" => "select2",
            "entity" => "origin",
            "attribute" => "name",
            "label" => trans("backpack::site.product_origin")
        ]);

        $this->crud->addField([
            "name" => "piece_id",
            "type" => "select2",
            "entity" => "piece",
            "attribute" => "name",
            "label" => trans("backpack::site.product_pieces")
        ]);

        $this->crud->addField([
            "name" => "brand_id",
            "type" => "select2",
            "entity" => "brand",
            "attribute" => "name",
            "label" => trans("backpack::site.product_brand")
        ]);
        $this->crud->addField([
            "name" => "colors",
            "type" => "select2_multiple",
            "entity" => "colors",
            "attribute" => "name",
            "label" => trans("backpack::site.product_color"),
            "pivot" => true
        ]);

        $this->crud->addField([
            "name" => "shipping_methods",
            "type" => "select2_multiple",
            "entity" => "shipping_methods",
            "attribute" => "name",
            "label" => trans("backpack::site.shipping_method"),
            "pivot" => true
        ]);

        $this->crud->addField([
            "name" => "image",
            "type" => "browse",
            "label" => trans("backpack::site.product_image")
        ]);

        $this->crud->addField([
            "name" => "images",
            "type" => "browse_multiple",
            "label" => trans("backpack::site.product_slide")
        ]);

        $this->crud->addField([
            "name" => "short_description",
            "type" => "summernote",
            "label" => trans("backpack::site.product_description")
        ]);

        $this->crud->addField([
            "name" => "content",
            "type" => "wysiwyg",
            "label" => trans("backpack::site.product_content")
        ]);

        $this->crud->addField([
           "name" => "custom_rating",
           "type" => "select2_from_array",
           "options" => [0,1,2,3,4,5],
            "label" => trans("backpack::site.product_rating")
        ]);

        $this->crud->removeButton("show");
    }


    protected function setupUpdateOperation()
    {

        if($this->crud->request->isMethod("put")){

            $product = $this->crud->getEntry($this->crud->getCurrentEntryId());

            if(($product->status == IN_STOCK && $this->crud->request->input("status") == PRE_ORDER) || ($product->stock > 0 && $this->crud->request->input("stock") <= 0 )){
                //Admin notify
                try{
                    Mail::send(new AdminNotifyInventory($product));
                }
                catch(\Exception $e){
                    logger($e->getMessage());
                }
            }

            if(($product->status == PRE_ORDER && $this->crud->request->input("status") == IN_STOCK) || ($product->stock <= 0 && $this->crud->request->input("stock") > 0 )){
                //Notify email to users
                try{
                    Mail::send(new InventoryNotify($product));
                }
                catch(\Exception $e){
                    logger($e->getMessage());
                }

            }

        }

        $this->setupCreateOperation();
    }
}
