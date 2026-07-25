<?php

use App\Http\Controllers\Front\HomeController;
use App\Models\Language;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\NewsletterController;



// მთავარი გვერდი
Route::get('/', [HomeController::class, 'index'])->name('home');
// ენის გადართვის როუთი
Route::get('/lang/{code}', function ($code) {
    if (Language::where('code', $code)->where('is_active', true)->exists()) {
        session(['locale' => $code]);
    }
    return redirect()->back();
})->name('lang.switch');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

