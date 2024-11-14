<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Customer;
use App\Models\CustomerBills;
use App\Models\CustomerOrder;

class AdminController extends Controller
{
	private function Customer(string $customer_name, string $whatsapp_number)
	{
		if (!session()->has("customer_id"))
			session(["customer_id" => uniqid()]);

		$data = new Customer;
		$data->customer_id = session("customer_id");
		$data->customer_name = $customer_name;
		$data->whatsapp_number = $whatsapp_number;
		$data->save();
	}

	private function CustomerBills(string $order_id, string $bill_time)
	{
		$data = new CustomerBills;
		$data->customer_id = session("customer_id");
		$data->employee_id = Auth::id();
		$data->order_id = $order_id;
		$data->bill_time = $bill_time;
		$data->save();
	}
	
	private function CustomerBillsGet()
	{
		return CustomerBills::orderBy("bill_id", "desc")->get();
	}

	public function MenuGet()
	{
		return Product::orderBy("product_name", "asc")->get();
	}
	
	public function MenuGetInfo($product_id, string $product_value)
	{
		$product_info = Product::find($product_id);

		if ($product_info)
		{
			if ($product_value == "product_name")
				return $product_info->product_name;
			else if ($product_value == "product_price")
				return $product_info->product_price;
		}
	}

	public function MenuOrder()
	{
		$products = $this->MenuGet();

		return view("admin.panel", compact("products"));
	}

	public function MenuOrderAdd(request $request)
	{
		// Get the current order_id from the session (or generate one if it's the first time)
		if (!session()->has("order_id"))
			session(["order_id" => uniqid()]);

		$order_id = session("order_id");
		$product_id = intval($request->product_id);

		// Check if the product is already in the session order list
		$orderData = session()->get("order_data", []);

		// Check if product already exists in the session
		if (isset($orderData[$product_id]))
		{
			$orderData[$product_id]["quantity"] += 1;
		}
		else
		{
			// Add new product to the session
			$orderData[$product_id] =
			[
				"product_id" => $product_id,
				"quantity" => 1
			];
		}

		// Save the order data to session
		session(["order_data" => $orderData]);

		return redirect()->back();
	}

	public function MenuOrderReduce(request $request)
	{
		// Get the current order_id from the session
		if (!session()->has("order_id"))
			return redirect()->back();

		$order_id = session("order_id");
		$product_id = intval($request->product_id);

		// Get the order data from session
		$orderData = session()->get("order_data", []);

		// If the product exists in the session order data
		if (isset($orderData[$product_id]))
		{
			if ($orderData[$product_id]["quantity"] > 1)
				$orderData[$product_id]["quantity"] -= 1;
			else
				unset($orderData[$product_id]);

			// Update the session with the modified order data
			session(["order_data" => $orderData]);
		}

		return redirect()->back();
	}

	public function MenuOrderSave(string $customer_name, string $whatsapp_number, string $bill_time)
	{
		// Get the current order_id from the session
		if (!session()->has("order_id") || !session()->has("order_data"))
			return redirect()->back();

		$order_id = session("order_id");
		$orderData = session("order_data");

		foreach ($orderData as $product_id => $item)
		{
			$data = new CustomerOrder;
			$data->order_id = $order_id;
			$data->product_id = $product_id;
			$data->quantity = $item["quantity"];
			$data->save();
		}

		// Customer DB
		$this->Customer($customer_name, $whatsapp_number);
		$this->CustomerBills($order_id, $bill_time);

		session()->forget("order_id");
		session()->forget("order_data");
		session()->forget("customer_id");

		return redirect()->back();
	}

	public function MenuOrderDelete()
	{
		session()->forget("order_id");
		session()->forget("order_data");
		session()->forget("customer_id");

		return redirect()->back();
	}

	public function MenuOrderHistory()
	{
		$customerBills = $this->CustomerBillsGet();

		return view("admin.panel", compact("customerBills"));
	}

	public function MenuEditDisplay()
	{
		$products = $this->MenuGet();

		return view("admin.panel", compact("products"));
	}

	public function MenuAdd(request $request)
	{
		$request->validate(
		[
			"product_name" => "required|string|max:64",
			"product_img" => "required|image",
			"product_description" => "nullable|string|max:64",
			"product_type" => "required|in:1,2",
			"product_subtype" => "nullable|in:1,2,3,4",
			"product_price" => "required|numeric"
		]);

		// Handle the image upload
		$file = $request->file("product_img");
		$fileName = time() . "-" . $file->getClientOriginalName();
		$file->move(resource_path("imgs/menus"), $fileName);

		$data = new Product;

		$data->product_name = $request->product_name;
		$data->product_img = $fileName;
		$data->product_description = isset($request->product_description) ? $request->product_description : "";
		$data->product_type = $request->product_type;
		$data->product_subtype = isset($request->product_subtype) ? $request->product_subtype : "";
		$data->product_price = $request->product_price;
		$data->save();
		
		return redirect()->back();
	}

	public function MenuEdit(request $request)
	{
		// Retrieve the existing product by its ID
		$data = Product::find($request->product_id);

		if (!$data)
			return redirect()->back()->with("error", "Product not found!");

		$data->product_name = $request->product_name;
		$data->product_description = isset($request->product_description) ? $request->product_description : "";
		$data->product_type = $request->product_type;
		$data->product_subtype = isset($request->product_subtype) ? $request->product_subtype : "";
		$data->product_price = $request->product_price;

		if ($request->hasFile('product_img'))
		{
			$file = $request->file("product_img");
			$fileName = time() . "-" . $file->getClientOriginalName();
			$file->move(resource_path("imgs/menus"), $fileName);
			$data->product_img = $fileName;
		}

		$data->save();
		
		return redirect()->back();
	}

	public function MenuDelete($product_id)
	{
		// Retrieve the existing product by its ID
		$data = Product::find($product_id);
		$data2 = CustomerOrder::find($product_id);

		if (!$data)
			return redirect()->back()->with("error", "Product not found!");

		$data->delete();

		if ($data2)
			$data2->delete();
		
		return redirect()->back();
	}
}