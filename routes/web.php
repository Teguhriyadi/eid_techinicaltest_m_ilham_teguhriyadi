<?php

use App\Http\Controllers\Autentikasi\LoginController;
use App\Http\Controllers\Master\MesinController;
use App\Http\Controllers\Modules\AppController;
use Illuminate\Support\Facades\Route;

Route::middleware(["web", "guest"])->group(function() {
    Route::prefix("auth")->group(function() {
        Route::get("/login", [LoginController::class, "login"]);
        Route::post("/login", [LoginController::class, "postLogin"]);
    });
});

Route::middleware(["web", "autentikasi"])->group(function() {
    Route::prefix("pages")->group(function() {
        Route::get("/dashboard", [AppController::class, "dashboard"]); 

        Route::get("/mesin/datatable", [MesinController::class, "datatable"]);
        Route::resource("mesin", MesinController::class);
    });

    Route::get("/auth/logout", [LoginController::class, "logout"]);
});