<?php

use App\Http\Controllers\MobileApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/mobile/login', [MobileApiController::class, 'login']);
Route::post('/mobile/register', [MobileApiController::class, 'register']);
Route::post('/mobile/logout', [MobileApiController::class, 'logout']);
Route::post('/resep/search', [MobileApiController::class, 'search']);
Route::post('/resep/create', [MobileApiController::class, 'createResep']);
Route::get('/kategori', [MobileApiController::class, 'kategori']);
Route::get('/user', [MobileApiController::class, 'userAktif']);
Route::get('/resep', [MobileApiController::class, 'resep']);
Route::get('/cek/login', [MobileApiController::class, 'cekLogin']);
