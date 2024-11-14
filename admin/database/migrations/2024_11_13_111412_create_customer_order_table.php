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
		Schema::create("customer_order", function(Blueprint $table)
		{
			$table->id();
			$table->string("order_id");
			$table->unsignedBigInteger("product_id");
			$table->integer("quantity");

			// Define the foreign key constraint
			$table->foreign("product_id")
				->references("product_id")
				->on("product")
				->onDelete("cascade");
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists("customer_order");
	}
};