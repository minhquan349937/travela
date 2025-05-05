<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clients\HomeController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
