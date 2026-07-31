<?php

use App\Http\Controllers\Autentikasi\LoginController;
use App\Http\Controllers\Master\MesinController;
use App\Http\Controllers\Master\OperatorController;
use App\Http\Controllers\Master\ProduksiController;
use App\Http\Controllers\Modules\AppController;
use App\Http\Controllers\Report\LaporanProduksiController;
use Illuminate\Support\Facades\Route;

Route::get("/", function() {
    return redirect()->to("/auth/login");
});

Route::middleware(["web", "guest"])->group(function() {
    Route::prefix("auth")->group(function() {
        Route::get("/login", [LoginController::class, "login"]);
        Route::post("/login", [LoginController::class, "postLogin"]);
    });
});

Route::middleware(["web", "autentikasi"])->group(function() {
    Route::prefix("pages")->group(function() {
        Route::get("/dashboard", [AppController::class, "dashboard"]); 
        Route::get("/dashboard/statistik", [AppController::class, "statistik"]);
        Route::get("/mesin/datatable", [MesinController::class, "datatable"]);
        Route::resource("mesin", MesinController::class);

        Route::patch('/operator/{id}/toggle-status', [OperatorController::class, 'toggleStatus']);
        Route::get("/operator/datatable", [OperatorController::class, "datatable"]);
        Route::resource("operator", OperatorController::class);

        Route::get("/produksi/datatable", [ProduksiController::class, "datatable"]);
        Route::resource("produksi", ProduksiController::class);

        Route::prefix("laporan-produksi")->group(function() {
            Route::get("", [LaporanProduksiController::class, "index"]);
            Route::get("/data", [LaporanProduksiController::class, "data"]);
        });
    });

    Route::get("/auth/logout", [LoginController::class, "logout"]);
});