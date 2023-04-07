<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\mailExampleController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

// USERS
Route::get('/users', [UserController::class, 'getUsers']);
Route::post('/users', [UserController::class, 'createUser']);
Route::put('/users', [UserController::class, 'updateUser']);
Route::delete('/users', [UserController::class, 'deleteUser']);

// PIZZAS
Route::get('/pizzas', [PizzaController::class, 'getPizzas']);
Route::get('/pizzas/{id}', [PizzaController::class, 'getPizzasById']);
Route::get('/pizzas/reviews/{id}', [PizzaController::class, 'getPizzasByIdWithReviews']);
Route::get('/pizzas/ingredientes/{id}', [PizzaController::class, 'getPizzasByIdWithIngredientes']);
Route::post('/pizzas', [PizzaController::class, 'createPizzas']);
Route::put('/pizzas/{id}', [PizzaController::class, 'updatePizzas']);
Route::delete('/pizzas/{id}', [PizzaController::class, 'deletePizzas']);
Route::post('/pizzas/addIngrediente/{id}', [PizzaController::class, 'addIngredienteToPizzaId']);
Route::delete('/pizzas/deleteIngrediente/{id}', [PizzaController::class, 'deleteIngredienteToPizzaId']);

// INGREDIENTES
Route::get('/ingredientes/{id}', [IngredienteController::class, 'getIngredientesByIdWithPizza']);

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// PROFILE
// Route::middleware('auth:sanctum')->get('/profile', [ProfileController::class, 'profile']);

// ROUTE GROUP
Route::group([
    'middleware' => 'auth:sanctum'
    ], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [ProfileController::class, 'profile']);
});

// REVIEWS
Route::group([
    'middleware' => 'auth:sanctum'
    ], function () {
    Route::post('/review', [ReviewController::class, 'createReview']);
});

// EMAILS
Route::get('/sendEmail', [mailExampleController::class, 'sendExampleEmail']);