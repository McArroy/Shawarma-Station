<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $table = "customer";
	protected $primaryKey = "customer_id";

	public $timestamps = false;

	public function product()
	{
		return $this->belongsTo(Product::class, "product_id", "product_id");
	}
}