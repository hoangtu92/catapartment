<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("username")->unique()->collation("utf8_unicode_ci");
            $table->string('name')->collation("utf8_unicode_ci");
            $table->string('email')->unique();
            $table->string('phone')->nullable(true);

            $table->string('role')->default("user");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(true);
            $table->date("birthday")->nullable(true);
            $table->string("zipcode")->nullable(true);
            $table->string("address")->nullable(true)->collation("utf8_unicode_ci");

            $table->bigInteger("points")->default(0);
            $table->rememberToken();

            $table->string('provider')->nullable(true);
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
        Schema::dropIfExists('users');
    }
}
