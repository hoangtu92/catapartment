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

            $table->bigInteger("shipping_fee")->default(0);
            $table->bigInteger("discount")->default(0)->change();
            $table->bigInteger("member_discount")->default(0);
            $table->bigInteger("total_amount")->default(0);
            $table->bigInteger("sub_total")->default(0);

            $table->string("country")->collation("utf8_unicode_ci")->default("Taiwan")->nullable(true);
            $table->string("state")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("company_name")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("email")->collation("utf8_unicode_ci")->nullable(true);

            $table->string("billing_name")->collation("utf8_unicode_ci");
            $table->string("billing_address")->collation("utf8_unicode_ci");
            $table->string("billing_address2")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("billing_zipcode")->collation("utf8_unicode_ci");
            $table->string("billing_phone")->collation("utf8_unicode_ci");

            $table->string("shipping_name")->collation("utf8_unicode_ci")->nullable(true);;
            $table->string("shipping_address")->collation("utf8_unicode_ci")->nullable(true);;
            $table->string("shipping_address2")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("shipping_zipcode")->collation("utf8_unicode_ci")->nullable(true);;
            $table->string("shipping_phone")->collation("utf8_unicode_ci")->nullable(true);;

            $table->string("delivery")->collation("utf8_unicode_ci")->default("pickup");
            $table->string("payment_method")->collation("utf8_unicode_ci")->default("ecpay");

            $table->text("notes")->collation("utf8_unicode_ci")->nullable(true);
            $table->string("checksum")->nullable(true);


            $table->text("payment_no")->nullable(true);
            $table->text("payment_type")->nullable(true);
            $table->dateTime("payment_date")->nullable(true);
            $table->enum("payment_status", [UNPAID, PAID, REFUNDING, REFUNDED])->default(UNPAID);
            $table->enum("delivery_status", [WAITING, DELIVERING, DELIVERED])->default(WAITING);
            $table->enum("status", [PROCESSING, COMPLETED, CANCELED])->default(PROCESSING);

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
