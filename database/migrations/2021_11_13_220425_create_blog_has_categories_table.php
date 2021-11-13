<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogHasCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_has_categories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('blog_id')->required();
            $table->foreign('blog_id')->references('id')->on('blogs');

            $table->unsignedBigInteger('blog_category_id')->required();
            $table->foreign('blog_category_id')->references('id')->on('blog_categories');

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
        Schema::dropIfExists('blog_has_categories');
    }
}
