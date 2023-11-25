<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\Room\RoomLoginController;
use App\Http\Controllers\Room\RoomStoreController;
use App\Http\Controllers\Room\RoomCreateController;
use App\Http\Controllers\Room\RoomThanksController;
use App\Http\Controllers\Image\ImageStoreController;
use App\Http\Controllers\Image\ImageCreateController;
use App\Http\Controllers\Button\ButtonStoreController;
use App\Http\Controllers\Button\ButtonCreateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

if(config('app.env') === 'ngrok'){
    URL::forceScheme('https');
}

Route::get('/', IndexController::class)->name('index');

Route::prefix('room')->name('room.')->group(function() {
    Route::post('/login', RoomLoginController::class)->name('login');
    Route::get('/create', RoomCreateController::class)->name('create');
    Route::post('/store', RoomStoreController::class)->name('store');
    Route::get('/thanks/{room_code}', RoomThanksController::class)->name('thanks');
});
Route::get('room/{room_code}', RoomController::class)->name('room');
Route::prefix('button')->name('button.')->group(function() {
    Route::get('/create/{room_code}', ButtonCreateController::class)->name('create');
    Route::post('/store/{room_code}', ButtonStoreController::class)->name('store');
});
Route::prefix('image')->name('image.')->group(function() {
    Route::get('/create/{room_code}', ImageCreateController::class)->name('create');
    Route::post('/store/{room_code}', ImageStoreController::class)->name('store');
});
