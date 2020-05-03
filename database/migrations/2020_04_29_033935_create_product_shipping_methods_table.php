<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductShippingMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shipping_methods', function (Blueprint $table) {
            $table->id();

            $table->foreignId("product_id");
            $table->foreign("product_id")->references("id")->on("products");

            $table->foreignId("shipping_method_id");
            $table->foreign("shipping_method_id")->references("id")->on("shipping_methods");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_shipping_methods');
    }
}
