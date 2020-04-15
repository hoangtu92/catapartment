<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string("content")->collation("utf8_unicode_ci");
            $table->integer("timing")->default(60);
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
        Schema::dropIfExists('announcements');
    }
}
