<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId');
            $table->string('fullName');
            $table->string('companyName')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->foreignId('country');
            $table->foreignId('state');
            $table->foreignId('city');
            $table->foreignId('upazilas');
            $table->string('coupon')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('postCode');
            $table->string('note')->nullable();
            $table->string('paymentMethod');
            $table->string('paymentStatus')->default(1)->comment('1=panding 2=paid');
            $table->string('productStatus')->default(1)->comment('1=processing 2=shipped 3=delivered');
            $table->string('diffShipping')->default(1)->comment('1 = no shipping 2 = shipping ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billings');
    }
}
