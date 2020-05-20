<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommend_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id");
            $table->foreign("product_id")->references("id")->on("products");
            $table->enum("category", ["熱賣拼圖", "新品預購", "換季促銷"])->default("熱賣拼圖")->collation("utf8_unicode_ci");
            $table->boolean("display")->nullable(true)->default(true);
            $table->date("valid_from")->nullable(true);
            $table->date("valid_until")->nullable(true);
            $table->integer("parent_id")->nullable(true)->default(0);
            $table->integer("lft")->default(0);
            $table->integer("rgt")->default(0);
            $table->integer("depth")->default(0);
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
        Schema::dropIfExists('recommend_products');
    }
}
