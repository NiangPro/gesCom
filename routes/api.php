<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\StaticDataController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\DevisController;

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
Route::middleware('auth:api')->get('/authentificated', function () {
    return true;
});

// Route::get('/admin', function () {
//     return view('auth.login');
// })->name('login');

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
Route::post('employedprofil', [EmployeController::class, 'editProfil']);


Route::get('/pays', [HomeController::class, 'getCountry']);
Route::get('/taxe', [HomeController::class, 'getTaxe']);
Route::get('/productType', [HomeController::class, 'getProductType']);
Route::get('/taskType', [HomeController::class, 'getTaskType']);
Route::get('/taskStatus', [HomeController::class, 'getTaskStatus']);
Route::get('/devisStatus', [HomeController::class, 'getDevisStatus']);
Route::get('/getEmployeds', [HomeController::class, 'getEmployeds']);
Route::get('/prospectSource', [HomeController::class, 'getProspectSource']);
Route::get('/expenseType', [HomeController::class, 'getExpenseType']);
Route::get('/paymentsMode', [HomeController::class, 'getPaymentsMode']);
Route::post('/register', [HomeController::class, 'register']);
Route::get('/sumSale', [HomeController::class, 'sumSale']);
Route::get('/sumExpense', [HomeController::class, 'sumExpense']);
Route::get('/saleByMonth', [HomeController::class, 'saleByMonth']);
Route::get('/expenseByMonth', [HomeController::class, 'expenseByMonth']);

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

Route::get('/task', [TaskController::class, 'index']);
Route::post('/task', [TaskController::class, 'store']);
Route::get('/task/show-{id}', [TaskController::class, 'show']);
Route::patch('/task/edit-{id}', [TaskController::class, 'update']);
Route::delete('/task/{id}', [TaskController::class, 'destroy']);

Route::get('/prospect', [ProspectController::class, 'index']);
Route::post('/prospect', [ProspectController::class, 'store']);
Route::get('/prospect/show-{id}', [ProspectController::class, 'show']);
Route::patch('/prospect/edit-{id}', [ProspectController::class, 'update']);
Route::delete('/prospect/{id}', [ProspectController::class, 'destroy']);

Route::get('/expense', [ExpenseController::class, 'index']);
Route::post('/expense', [ExpenseController::class, 'store']);
Route::get('/expense/show-{id}', [ExpenseController::class, 'show']);
Route::patch('/expense/edit-{id}', [ExpenseController::class, 'update']);
Route::delete('/expense/{id}', [ExpenseController::class, 'destroy']);

Route::get('/reunion', [ReunionController::class, 'index']);
Route::post('/reunion', [ReunionController::class, 'store']);
Route::get('/reunion/show-{id}', [ReunionController::class, 'show']);
Route::patch('/reunion/edit-{id}', [ReunionController::class, 'update']);
Route::delete('/reunion/{id}', [ReunionController::class, 'destroy']);

Route::get('/vente', [VenteController::class, 'index']);
Route::post('/vente', [VenteController::class, 'store']);
Route::get('/vente/show-{id}', [VenteController::class, 'show']);
Route::patch('/vente/edit-{id}', [VenteController::class, 'update']);
Route::delete('/vente/{id}', [VenteController::class, 'destroy']);
Route::get('/productSalling/{id}', [VenteController::class, 'getProducts']);
Route::get('/produitVendus', [VenteController::class, 'produitVendus']);

Route::post('/todo', [TodoController::class, 'store']);
Route::get('/todo', [TodoController::class, 'index']);
Route::post('/todoEtat', [TodoController::class, 'todoCheck']);
Route::get('/todo/{id}', [TodoController::class, 'show']);
Route::patch('/editTodo/{id}', [TodoController::class, 'update']);
Route::delete('/todo/{id}', [TodoController::class, 'destroy']);

Route::get('/history', [HistoryController::class, 'index']);

Route::get('/devis', [DevisController::class, 'index']);
Route::post('/devis', [DevisController::class, 'store']);
Route::delete('/devis/{id}', [DevisController::class, 'destroy']);
Route::get('/devisItems', [DevisController::class, 'devisItems']);
Route::get('/devisItems/{id}', [DevisController::class, 'itemsDevis']);
Route::get('/devis/show-{id}', [DevisController::class, 'show']);
