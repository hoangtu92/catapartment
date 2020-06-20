<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockNotifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_notifies', function (Blueprint $table) {
            $table->id();
            $table->foreignId("newsletter_id");
            $table->foreign("newsletter_id")->references("id")->on("newsletters");

            $table->foreignId("product_id");
            $table->foreign("product_id")->references("id")->on("products");

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
        Schema::dropIfExists('stock_notifies');
    }
}
