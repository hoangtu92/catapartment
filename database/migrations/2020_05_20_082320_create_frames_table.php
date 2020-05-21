<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frames', function (Blueprint $table) {
            $table->id();
            $table->string("sku")->unique()->nullable(false);
            $table->string("name")->collation("utf8_unicode_ci");
            $table->decimal("price");
            $table->decimal("sale_price");
            $table->integer("stock")->default(0);
            $table->decimal("time")->default(0);

            $table->string("image")->collation("utf8_unicode_ci")->nullable(true);
            $table->json("images")->nullable(true);

            $table->text("short_description")->collation("utf8_unicode_ci")->nullable(true);
            $table->text("content")->collation("utf8_unicode_ci")->nullable(true);

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
        Schema::dropIfExists('frames');
    }
}
