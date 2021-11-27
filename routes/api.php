<?php

use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\RegisterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ユーザー登録
Route::post('/register', [RegisterController::class, 'register']);

// ログイン
Route::post('/login', [LoginController::class, 'login']);

Route::apiResource('questions', QuestionController::class)
    ->middleware('auth:sanctum')
    ->only(['store', 'update']);

Route::apiResource('questions', QuestionController::class)
    ->only(['index', 'show']);

Route::apiResource('questions.answers', AnswerController::class)
    ->middleware('auth:sanctum')
    ->only('store');
