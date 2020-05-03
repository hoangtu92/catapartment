<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string("name")->collation("utf8_unicode_ci");
            $table->string("country")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("logo")->collation("utf8_unicode_ci")->nullable(true);
            $table->text("description")->collation("utf8_unicode_ci")->nullable(true);
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
        Schema::dropIfExists('brands');
    }
}
