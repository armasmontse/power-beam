<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('photo_user', function (Blueprint $table) {
            $table->integer('photo_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->string('use')->default('thumbnail');
            $table->unsignedInteger('order')->nullable();
            $table->string('class')->nullable();

            $table->unique(['use', 'order', 'user_id']);
            $table->unique(['photo_id', 'use', 'user_id']);

            $table  ->foreign('photo_id')
                    ->references('id')
                    ->on('photos')
                    ->onDelete('RESTRICT');
            $table  ->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('RESTRICT');

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
        //
        Schema::dropIfExists('photo_users');
    }
}
