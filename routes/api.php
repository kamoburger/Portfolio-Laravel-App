<?php

use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get("/blogs", [BlogController::class, "index"]);

Route::get("/blog/{id}", [BlogController::class, "show"]);

Route::post("/store", [BlogController::class, "store"]);

Route::post("/update/{id}", [BlogController::class, "update"]);

Route::post("/delete/{id}", [BlogController::class, "delete"]);

