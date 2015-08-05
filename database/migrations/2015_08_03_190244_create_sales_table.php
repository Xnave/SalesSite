<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	//TODO: text: input separated with comma
	public function up()
	{
		Schema::create('sales', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('store_id')->unsigned()->nullable();
			$table->integer('type_id');
			$table->tinyInteger('percentage')->nullable();
			$table->integer('amount')->nullable();
			$table->text('items');
			$table->string('text', 250);
			$table->date('start_day');
			$table->date('end_day');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			$table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
			$table->foreign('type_id')->references('id')->on('types');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sales');
	}

}
