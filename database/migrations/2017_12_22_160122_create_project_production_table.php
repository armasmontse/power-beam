<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectProductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_production', function (Blueprint $table)
        {
        	$table->integer('project_id')->unsigned();
        	$table->foreign('project_id')->references('id')->on('projects')->onDelete('RESTRICT');
        	$table->text('data')->nullable();
        	$table->text('stackup')->nullable();
        	$table->text('routing')->nullable();
        	$table->text('highspeed')->nullable();
        	$table->text('power_supply')->nullable();
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
        Schema::dropIfExists('project_production');
    }
}
