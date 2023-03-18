<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pegawai\PegawaiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    ["middleware" => ["auth", "admin"], "prefix" => "admin"],
    function () {
        Route::get("/", [AdminController::class, "index"]);
        Route::group(["prefix" => "pegawai"], function () {
            Route::get("/", [AdminController::class, "pegawai"]);
            Route::post("/", [AdminController::class, "pegawaiPost"]);
            Route::get("/{pegawai:id}", [
                AdminController::class,
                "showPegawai",
            ]);
            Route::post("/{pegawai:id}/edit", [
                AdminController::class,
                "editPegawai",
            ]);
            Route::get("/{pegawai:id}/delete", [
                AdminController::class,
                "deletePegawai",
            ]);
        });
    }
);
Route::group(
    ["middleware" => ["auth", "pegawai"], "prefix" => "pegawai"],
    function () {
        Route::get("/", [PegawaiController::class, "index"]);
        Route::post("/", [PegawaiController::class, "postIndex"]);
    }
);

Route::get("/auth/signin", [AuthController::class, "index"])
    ->middleware("guest")
    ->name("login");
Route::post("/auth/signin", [AuthController::class, "postIndex"]);
Route::post("/auth/logout", [AuthController::class, "logout"]);

Route::get("/", function () {
    return view("index");
})->middleware("guest");
