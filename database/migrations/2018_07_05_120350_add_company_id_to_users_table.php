<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('users', function (Blueprint $table) {
        	$table->integer('company_id')->after('deleted_at')->unsigned()->nullable();
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('users', function (Blueprint $table) {
    	    $table->dropForeign(['company_id']);
    	    $table->dropColumn('company_id');
    	});
    }
}
