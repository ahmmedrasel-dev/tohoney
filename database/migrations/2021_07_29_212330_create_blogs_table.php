<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->foreignId('subcat_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('views')->default(0);
            $table->text('short_description');
            $table->string('thumbnail')->nullable();
            $table->string('feature_image')->nullable();
            $table->string('status')->default(1)->comment('1=active, 2=deactive');
            $table->string('feature_post')->default(1)->comment('1=general Post, 2=feature post');
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
        Schema::dropIfExists('blogs');
    }
}
