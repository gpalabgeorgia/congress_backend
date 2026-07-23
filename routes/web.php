<?php

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;



// მთავარი გვერდი
Route::get('/', [HomeController::class, 'index'])->name('home');

