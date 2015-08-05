<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsSalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('brands_sales', function(Blueprint $table)
		{
			$table->integer('brand_id');
			$table->integer('sale_id');
			$table->timestamps();
			$table->primary(array('brand_id', 'sale_id'));

			$table->foreign('brand_id')->references('id')->on('brands');
			$table->foreign('sale_id')->references('id')->on('sales');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('brands_sales');
	}

}
