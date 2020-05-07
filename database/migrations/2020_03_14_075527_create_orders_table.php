<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique(true);

            $table->foreignId('user_id')->nullable(true);
            $table->foreign("user_id")->references("id")->on("users");

            $table->decimal("shipping_fee")->default(0);
            $table->decimal("discount")->default(0);
            $table->decimal("total_amount")->default(0);

            $table->string("country")->collation("utf8_unicode_ci")->default("Taiwan")->nullable(true);
            $table->string("state")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("company_name")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("email")->collation("utf8_unicode_ci")->nullable(true);

            $table->string("billing_name")->collation("utf8_unicode_ci");
            $table->string("billing_address")->collation("utf8_unicode_ci");
            $table->string("billing_address2")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("billing_zipcode")->collation("utf8_unicode_ci");
            $table->string("billing_phone")->collation("utf8_unicode_ci");

            $table->string("shipping_name")->collation("utf8_unicode_ci");
            $table->string("shipping_address")->collation("utf8_unicode_ci");
            $table->string("shipping_address2")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("shipping_zipcode")->collation("utf8_unicode_ci");
            $table->string("shipping_phone")->collation("utf8_unicode_ci");

            $table->string("delivery")->collation("utf8_unicode_ci")->default("pickup");
            $table->string("payment_method")->collation("utf8_unicode_ci")->default("ecpay");

            $table->text("notes")->collation("utf8_unicode_ci")->nullable(true);

            $table->text("status")->collation("utf8_unicode_ci")->nullable(true);

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
        Schema::dropIfExists('orders');
    }
}
