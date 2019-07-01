<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('code')->unique();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('RESTRICT');

            $table->integer('manager_id')->unsigned()->nullable();
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('RESTRICT');

            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('RESTRICT');

            $table->text('error')->nullable();
            $table->timestamp('read_at')->nullable();

            $table->timestamps();
        });

        Schema::create('file_project', function (Blueprint $table)
        {
        	$table->integer('project_id')->unsigned();
        	$table->foreign('project_id')->references('id')->on('projects')->onDelete('RESTRICT');

        	$table->integer('file_id')->unsigned();
        	$table->foreign('file_id')->references('id')->on('files')->onDelete('RESTRICT');

        	$table->string('use');

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
        Schema::dropIfExists('file_project');
        Schema::dropIfExists('projects');
    }
}
