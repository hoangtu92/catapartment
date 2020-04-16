<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatestProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latest_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->unique(true);
            $table->foreign("product_id")->references("id")->on("products");
            $table->boolean("display")->nullable(true)->default(true);
            $table->date("valid_from")->nullable(true);
            $table->date("valid_until")->nullable(true);
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
        Schema::dropIfExists('latest_products');
    }
}
