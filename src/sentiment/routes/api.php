<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sentiment\SentimentStoreController;
use App\Http\Controllers\Sentiment\SentimentResultController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('sentiment')->name('sentiment.')->group(function() {
    Route::post('store', SentimentStoreController::class)->name('store');
    Route::get('result/{room_code}', SentimentResultController::class)->name('result');
});
