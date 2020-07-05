<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId("order_id");
            $table->foreign("order_id")->references("id")->on("orders");

            $table->foreignId("product_id")->nullable(true);
            $table->foreign("product_id")->references("id")->on("products");

            $table->string("product_name")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("product_image")->collation("utf8_unicode_ci")->nullable(true);

            $table->json("attr")->nullable(true);

            $table->decimal("price");
            $table->integer("qty");

            $table->text("review")->nullable(true)->collation("utf8_unicode_ci");
            $table->integer("rating")->nullable(true);

            $table->dateTime("review_date")->nullable(true);

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
        Schema::dropIfExists('order_items');
    }
}
