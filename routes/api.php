<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\NoteController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //return $request->user();
//});

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    Route::post('register', [AuthenticationController::class, 'register']);
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::post('logout', [AuthenticationController::class, 'logout'])->middleware('auth:api');
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('notes', [NoteController::class, 'index']);
        Route::post('notes', [NoteController::class, 'store']);
        Route::get('notes/{id}', [NoteController::class, 'show']);
        Route::put('notes/{id}', [NoteController::class, 'update']);
        Route::delete('notes/{id}', [NoteController::class, 'destroy']);
    });
});


