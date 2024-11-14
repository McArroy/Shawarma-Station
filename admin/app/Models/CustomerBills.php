<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerBills extends Model
{
	protected $table = "customer_bills";
	protected $primaryKey = "bill_id";

	public $timestamps = false;
}