<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Models\Answer;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return redirect()->route('questions.index');
});

Route::middleware(['auth:sanctum', 'verified'])
->get('/dashboard', [UserController::class, 'show']
)->name('dashboard');

Route::get('questions/new', [QuestionController::class, 'new'])
    ->name('questions.new');

Route::get('questions/popular', [QuestionController::class, 'popular'])
    ->name('questions.popular');

Route::resource('questions', QuestionController::class)
    ->middleware('auth')
    ->only(['create', 'store', 'edit', 'update', 'destroy']);

Route::get('questions/{question}/close', [QuestionController::class, 'close'])
    ->middleware('auth')
    ->name('questions.close');

Route::patch('questions/{question}/close', [QuestionController::class, 'divide'])
    ->middleware('auth')
    ->name('questions.divide');

Route::resource('questions', QuestionController::class)
    ->only(['show', 'index']);

Route::resource('questions.answers', AnswerController::class)
    ->middleware('auth')
    ->only('store');

Route::get('purchase', [PurchaseController::class, 'purchase'])
    ->middleware('auth')
    ->name('purchase');

Route::patch('purchase', [PurchaseController::class, 'buy'])
    ->middleware('auth')
    ->name('buy');

Route::get('giftcard', [PurchaseController::class, 'giftcard'])
    ->middleware('auth')
    ->name('giftcard');

Route::patch('giftcard', [PurchaseController::class, 'exchange'])
    ->middleware('auth')
    ->name('exchange');

Route::get('thanks', [PurchaseController::class, 'thanks'])
    ->middleware('auth')
    ->name('thanks');

Route::get('user/{user}', [UserController::class, 'show'])
    ->name('user.show');
