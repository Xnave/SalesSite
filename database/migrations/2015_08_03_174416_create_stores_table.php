<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stores', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('phone', 12)->nullable()->unique();
			$table->string('address', 100)->unique();
			$table->integer('brand_id')->unsigned()->nullable();
			$table->integer('center_id')->unsigned()->nullable();
			$table->timestamps();

			$table->foreign('brand_id')->references('id')->on('brands');
			$table->foreign('center_id')->references('id')->on('centers');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stores');
	}

}
