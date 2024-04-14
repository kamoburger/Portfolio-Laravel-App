<?php

use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/blogs", [BlogController::class, "index"]);

Route::get("/blog/{id}", [BlogController::class, "show"]);

Route::post("/store", [BlogController::class, "store"]);

