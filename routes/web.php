<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\tagsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\getHoursController;


Route::middleware("auth")->group(function(){
    Route::get('welcome', [HomeController::class, 'index'])->name('home');
    Route::get('index', [tagsController::class, 'index'])->name('index');
    Route::get('refresh-employe', [tagsController::class, 'index'])->name('index');
    Route::post("/get-tags", [tagsController::class, "refreshTagsData"])->name("refreshTagsData");

});

Route::get("/", [AuthController::class, "login"])->name('login');
Route::post("/login", [AuthController::class, "loginPost"])->name("login.post");
