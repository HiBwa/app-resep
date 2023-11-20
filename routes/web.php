<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ResepController;
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
    return view('welcome');
});

Auth::routes();


Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')->middleware('auth')->group(
    function () {
        Route::get('/', function () {
            return view('layouts.home');
        });
        // route kategori
        Route::get('resep-kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('resep-kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::get('resep-kategori/{id}/show', [KategoriController::class, 'show'])->name('kategori.show');
        Route::get('resep-kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::patch('resep-kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::post('resep-kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::delete('resep-kategori/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');


        // resep Controller
        Route::get('/resep-masakan', [ResepController::class, 'index'])->name('resep.index');
        Route::get('/resep-masakan/create', [ResepController::class, 'create'])->name('resep.create');
        Route::get('/resep-masakan/{id}/show', [ResepController::class, 'show'])->name('resep.show');
        Route::get('/resep-masakan/{id}/edit', [ResepController::class, 'edit'])->name('resep.edit');
        Route::patch('/resep-masakan/{id}', [ResepController::class, 'update'])->name('resep.update');
        Route::post('/resep-masakan/store', [ResepController::class, 'store'])->name('resep.store');
        Route::delete('/resep-masakan/destroy/{id}', [ResepController::class, 'destroy'])->name('resep.destroy');
    }
);
