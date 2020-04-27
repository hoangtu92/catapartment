<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id");
            $table->foreign("product_id")->references("id")->on("products");

            $table->decimal("price");
            $table->integer("qty");
            $table->decimal("shipping_fee")->default(0);

            $table->decimal("total_amount");


            $table->string("billing_name")->collation("utf8_unicode_ci");
            $table->string("billing_address")->collation("utf8_unicode_ci");
            $table->string("billing_zipcode")->collation("utf8_unicode_ci");

            $table->string("shipping_name")->collation("utf8_unicode_ci");
            $table->string("shipping_address")->collation("utf8_unicode_ci");
            $table->string("shipping_zipcode")->collation("utf8_unicode_ci");

            $table->text("notes")->collation("utf8_unicode_ci")->nullable(true);
            $table->text("review")->collation("utf8_unicode_ci")->nullable(true);

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
        Schema::dropIfExists('orders');
    }
}
