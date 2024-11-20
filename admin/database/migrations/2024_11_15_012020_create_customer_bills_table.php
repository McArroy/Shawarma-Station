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
		Schema::create("customer_bills", function(Blueprint $table)
		{
			$table->id("bill_id", 11);
			$table->string("customer_id");
			$table->string("employee_id");
			$table->string("order_id");
			$table->string("bill_time");
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists("customer_bills");
	}
};