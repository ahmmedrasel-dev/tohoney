<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billingId');
            $table->string('fullName');
            $table->string('companyName')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->foreignId('country');
            $table->foreignId('state');
            $table->foreignId('city');
            $table->foreignId('upazilas');
            $table->string('postCode');
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
        Schema::dropIfExists('shippings');
    }
}
