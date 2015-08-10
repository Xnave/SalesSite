<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_stores', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			$table->integer('store_id')->unsigned();
			$table->tinyInteger('grading')->nullable();
			$table->timestamps();

			//delete is restricted in order to pass the views data to another table before delete
			$table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
			$table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
			$table->primary(array('store_id', 'user_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_stores');
	}

}
