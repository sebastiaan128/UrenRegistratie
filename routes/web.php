<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tagsController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('index', [tagsController::class, 'index'])->name('index');

