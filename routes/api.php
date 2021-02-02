<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaticDataController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/staticdata', [StaticDataController::class, 'index']);
Route::post('/staticdata', [StaticDataController::class, 'store']);
Route::get('/staticdata/show-{id}', [StaticDataController::class, 'show']);
Route::get('/staticdata/fonction', [StaticDataController::class, 'getFonction']);
Route::patch('/staticdata/edit-{id}', [StaticDataController::class, 'update']);
Route::delete('/staticdata/{id}', [StaticDataController::class, 'destroy']);

Route::get('/employe', [EmployeController::class, 'index']);
Route::post('/employe', [EmployeController::class, 'store']);
Route::get('/employe/show-{id}', [EmployeController::class, 'show']);
Route::patch('/employe/edit-{id}', [EmployeController::class, 'update']);
Route::delete('/employe/{id}', [EmployeController::class, 'destroy']);

Route::get('/pays', [ClientController::class, 'getCountry']);
Route::get('/taxe', [HomeController::class, 'getTaxe']);
Route::get('/productType', [HomeController::class, 'getProductType']);

Route::get('/client', [ClientController::class, 'index']);
Route::post('/client', [ClientController::class, 'store']);
Route::get('/client/show-{id}', [ClientController::class, 'show']);
Route::patch('/client/edit-{id}', [ClientController::class, 'update']);
Route::delete('/client/{id}', [ClientController::class, 'destroy']);

Route::get('/fournisseur', [FournisseurController::class, 'index']);
Route::post('/fournisseur', [FournisseurController::class, 'store']);
Route::get('/fournisseur/show-{id}', [FournisseurController::class, 'show']);
Route::patch('/fournisseur/edit-{id}', [FournisseurController::class, 'update']);
Route::delete('/fournisseur/{id}', [FournisseurController::class, 'destroy']);

Route::get('/product', [ProductController::class, 'index']);
Route::post('/product', [ProductController::class, 'store']);
Route::get('/product/show-{id}', [ProductController::class, 'show']);
Route::patch('/product/edit-{id}', [ProductController::class, 'update']);
Route::delete('/product/{id}', [ProductController::class, 'destroy']);
