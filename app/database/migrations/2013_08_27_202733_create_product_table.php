<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('article_id');
			$table->integer('product_number');
			$table->string('name');
			$table->string('name_2');
			$table->decimal('volume', 4, 2)->index();
			$table->decimal('price', 8, 2)->index();
			$table->decimal('price_per_liter', 8, 2)->index();
			$table->decimal('alcohol', 2, 2)->index();
			$table->decimal('apk', 4, 2)->index();
			$table->integer('year')->nullable();
			$table->boolean('ecological')->default(false);
			$table->boolean('koscher')->default(false);
			$table->softDeletes();
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
		Schema::drop('product');
	}

}
