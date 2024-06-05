<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\tagsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\getHoursController;
use App\Http\Controllers\getTimeEntriesController;



Route::middleware("auth")->group(function(){
    Route::get('welcome', [HomeController::class, 'index'])->name('home');
    Route::get('index', [tagsController::class, 'index'])->name('index');
    Route::get("/get-tags", [tagsController::class, "refreshTagsData"])->name("refreshTagsData");
    Route::get("/get-employe", [getHoursController::class, "getEmployees"])->name("getEmployees");
    Route::get("/get-timeentries", [getTimeEntriesController::class, "getTimeEntries"])->name("getTimeEntries");
    Route::post("/get-hours", [getHoursController::class, "getHours"])->name("filterUren");

});

Route::get("/", [AuthController::class, "login"])->name('login');
Route::post("/login", [AuthController::class, "loginPost"])->name("login.post");
