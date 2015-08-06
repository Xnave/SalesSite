<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBrandsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_brands', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			$table->integer('brand_id')->unsigned();
			$table->tinyInteger('grading')->nullable();
			$table->integer('number_of_views')->default(0);
			$table->timestamps();

			//delete is restricted in order to pass the views data to another table before delete
			$table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
			$table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
			$table->primary(array('brand_id', 'user_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_brands');
	}

}
