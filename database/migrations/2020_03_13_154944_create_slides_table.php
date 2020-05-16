<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string("title")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("link")->nullable(true)->collation("utf8_unicode_ci");
            $table->string("image")->collation("utf8_unicode_ci");
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
        Schema::dropIfExists('slides');
    }
}
