<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->enum("type", ['google廣告碼', '圖檔'])->default("google廣告碼");
            $table->longText("code")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("image")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("url")->collation("utf8_unicode_ci")->nullable(true);
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
        Schema::dropIfExists('advertisements');
    }
}
