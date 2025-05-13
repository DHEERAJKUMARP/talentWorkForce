<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Auth\RegisterController;


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
 
Route::prefix('auth')->group(function () {
    Route::post('/register', [RegisterController::class, 'register']);
});
Route::get('/sample', function () {
    return response()->json([
        'message' => 'Hello from Laravel API!',
        'status' => 'success'
    ]);
});
 
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
