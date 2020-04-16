<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("category_id")->references("id")->on("product_categories");
            $table->string("name")->nullable(false)->collation("utf8_unicode_ci")->unique();
            $table->string("slug")->nullable(true)->collation("utf8_unicode_ci")->unique();
            $table->double("price")->default(0);
            $table->double("sale_price")->default(0);
            $table->string("image")->collation("utf8_unicode_ci");
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
        Schema::dropIfExists('products');
    }
}
