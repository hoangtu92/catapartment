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
            $table->foreignId("category_id")->nullable(true);
            $table->foreign("category_id")->references("id")->on("product_categories");
            $table->string("name")->nullable(false)->collation("utf8_unicode_ci");
            $table->string("slug", 255)->nullable(true)->collation("utf8_unicode_ci")->unique();
            $table->string("sku")->nullable(true);
            $table->enum("status", [PRE_ORDER, IN_STOCK])->default(PRE_ORDER);
            $table->integer("stock")->nullable(true)->default(0);

            $table->integer("price")->default(0);
            $table->integer("sale_price")->nullable(true)->default(null);
            $table->integer("view")->default(0);

            $table->string("image")->collation("utf8_unicode_ci");
            $table->json("images")->nullable(true);

            $table->text("short_description")->collation("utf8_unicode_ci")->nullable(true);
            $table->text("content")->collation("utf8_unicode_ci")->nullable(true);

            $table->foreignId("brand_id")->nullable(true);
            $table->foreign("brand_id")->references("id")->on("brands");

            $table->foreignId("origin_id")->nullable(true);
            $table->foreign("origin_id")->references("id")->on("origins");

            $table->foreignId("piece_id")->nullable(true);
            $table->foreign("piece_id")->references("id")->on("pieces");

            $table->string("piece_value")->nullable(true);

            $table->string("measures")->collation("utf8_unicode_ci")->nullable(true);

            $table->string("keywords")->collation("utf8_unicode_ci")->nullable(true);

            $table->string("barcode")->collation("utf8_unicode_ci")->nullable(true);

            $table->integer("custom_rating")->default(0);

            $table->enum("type", [FRAME, NORMAL])->default(NORMAL);
            $table->decimal("time")->default(0);
            $table->string("pid")->nullable(true);
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
