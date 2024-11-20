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
		Schema::create("customer", function(Blueprint $table)
		{
			$table->string("customer_id", 11);
			$table->string("customer_name", 32);
			$table->string("whatsapp_number", 32);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists("customer");
	}
};