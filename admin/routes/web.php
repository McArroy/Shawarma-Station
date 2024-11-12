<?php

use Illuminate\Support\Facades\Route;

Route::get("/", function()
{
	return redirect()->route("order");
});

Route::get("/register", function()
{
	return redirect()->route("order");
});

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

	Route::get("/order", function()
	{
		return view("admin.panel");
	})->name("order");

	Route::get("/history", function()
	{
		return view("admin.panel");
	})->name("history");

	Route::get("/edit", function()
	{
		return view("admin.panel");
	})->name("edit");
});