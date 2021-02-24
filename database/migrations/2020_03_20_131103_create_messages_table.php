<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string("customer_ip");
            $table->string("customer_name")->collation("utf8_unicode_ci");
            $table->string("customer_phone")->collation("utf8_unicode_ci");
            $table->string("customer_email")->collation("utf8_unicode_ci");
            $table->string("customer_free_time")->collation("utf8_unicode_ci");
            $table->text("customer_message")->collation("utf8_unicode_ci");
            $table->string("customer_subject")->collation("utf8_unicode_ci");
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
        Schema::dropIfExists('messages');
    }
}
