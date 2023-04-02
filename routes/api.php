<?php

use App\Http\Controllers\JWTController;
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
    $data = [
        'message' => "Welcome to our API"
    ];
    return response()->json($data, 200);
})->name('welcome');

Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('/register', [JWTController::class, 'register']);
    Route::post('/login', [JWTController::class, 'login']);

    Route::group(['middleware' => ['jwt.verify']], function ($router) {
        Route::post('/logout', [JWTController::class, 'logout']);
        Route::post('/refresh', [JWTController::class, 'refresh']);
        Route::post('/profile', [JWTController::class, 'profile']);
    });
});


//Rutas publicas

// Rutas protegidas
Route::group(['middleware' => ['jwt.verify']], function ($router) {
});
