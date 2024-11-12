<?php

use Illuminate\Support\Facades\Route;

Route::get("/", function()
{
	return redirect()->route("adminpanel");
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
		return redirect()->route("adminpanel");
	})->name("home");

	Route::get("/dashboard", function()
	{
		return redirect()->route("adminpanel");
	})->name("dashboard");

	Route::get("/adminpanel", function()
	{
		return view("admin.panel");
	})->name("adminpanel");
});