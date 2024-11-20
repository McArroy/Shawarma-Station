<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up() : void
	{
		Schema::create("product", function(Blueprint $table)
		{
			$table->id("product_id", 7);
			$table->string("product_name", 64);
			$table->string("product_img", 2048);
			$table->string("product_description", 64)->nullable();
			$table->integer("product_type");
			$table->integer("product_subtype")->nullable();
			$table->integer("product_price");
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists("product");
	}
};