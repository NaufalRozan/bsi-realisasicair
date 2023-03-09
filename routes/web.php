<?php

use App\Http\Controllers\HarianController;
use App\Models\Harian;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/data', [App\Http\Controllers\DataController::class, 'index'])->name('data');
Route::post('/data', [App\Http\Controllers\DataController::class, 'create'])->name('add.data');
Route::get('/data/{id_data}/edit', [App\Http\Controllers\DataController::class, 'edit']);
Route::post('/data/{id_data}/update', [App\Http\Controllers\DataController::class, 'update'])->name('update.data');
Route::get('/data/delete/{id_data}', [DataController::class, 'delete']);

Route::get('/grafik', [App\Http\Controllers\DataController::class, 'grafik'])->name('grafik');

Route::get('/harian', [App\Http\Controllers\HarianController::class, 'index'])->name('harian');
Route::post('/harian', [App\Http\Controllers\HarianController::class, 'create'])->name('add.harian');
Route::get('/harian/{id_harian}/edit', [App\Http\Controllers\HarianController::class, 'edit']);
Route::post('/harian/{id_harian}/update', [App\Http\Controllers\HarianController::class, 'update'])->name('update.harian');
Route::get('/harian/delete/{id_harian}', [HarianController::class, 'delete']);

Route::get('/cabang', [App\Http\Controllers\CabangController::class, 'index'])->name('cabang');
Route::post('/cabang', [App\Http\Controllers\CabangController::class, 'create'])->name('add.cabang');

Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'create'])->name('add.register');

Route::get('/marketing', [App\Http\Controllers\MarketingController::class, 'index'])->name('marketing');
Route::post('/marketing', [App\Http\Controllers\MarketingController::class, 'create'])->name('add.marketing');
Route::get('/marketing/{id}/edit', [App\Http\Controllers\MarketingController::class, 'edit'])->name('edit');
Route::post('/marketing/{id_harian}/update', [App\Http\Controllers\MarketingController::class, 'update'])->name('update.marketing');


Route::get('/podium', [App\Http\Controllers\PodiumController::class, 'index'])->name('podium');

Route::get('/keseluruhan', [App\Http\Controllers\HarianController::class, 'keseluruhan'])->name('keseluruhan');

Route::get('/user', function () {
    return Auth::user();
});



Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
