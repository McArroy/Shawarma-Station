<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

Route::get("/", function()
{
	return redirect()->route("order");
});

Route::get("/register", function()
{
	return redirect()->route("order");
});

Route::get("/menu/get", [AdminController::class, "MenuGet"])->name("menu.get");

Route::get("/imgs/menus/{filename}", function($filename)
{
	$path = resource_path("imgs/menus/" . $filename);

	if (file_exists($path))
		return response()->file($path);

	abort(404, "Image not found");
})->name("menu.get.images");

Route::middleware(
[
	"auth:sanctum",
	config("jetstream.auth_session"),
	"verified"
])->group(function()
{
	Route::get("/", function()
	{
		return redirect()->route("order");
	})->name("home");

	Route::get("/dashboard", function()
	{
		return redirect()->route("order");
	})->name("dashboard");

	Route::get("/order", [AdminController::class, "MenuOrder"])->name("order");
	Route::post("/order/add", [AdminController::class, "MenuOrderAdd"])->name("order.add");
	Route::post("/order/reduce", [AdminController::class, "MenuOrderReduce"])->name("order.reduce");
	Route::get("/order/delete", [AdminController::class, "MenuOrderDelete"])->name("order.delete");
	Route::get("/order/save/{customer_name}/{whatsapp_number}/{bill_time}", [AdminController::class, "MenuOrderSave"])->name("order.save");

	Route::get("/history", [AdminController::class, "MenuOrderHistory"])->name("history");

	Route::get("/edit", [AdminController::class, "MenuEditDisplay"])->name("edit");
	Route::post("/edit/update", [AdminController::class, "MenuEdit"])->name("edit.update");
	Route::post("/edit/create", [AdminController::class, "MenuAdd"])->name("edit.create");
	Route::get("/edit/delete/{product_id}", [AdminController::class, "MenuDelete"])->name("edit.delete");
});