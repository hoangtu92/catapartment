<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId("order_id");
            $table->foreign("order_id")->references("id")->on("orders");

            $table->decimal("amount")->default(0);

            $table->text("payment_no")->nullable(true);
            $table->text("payment_type")->nullable(true);
            $table->dateTime("payment_date")->nullable(true);
            $table->string("checksum")->nullable(true);

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
        Schema::dropIfExists('transactions');
    }
}
