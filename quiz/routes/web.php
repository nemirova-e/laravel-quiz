<?php

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



Route::get('/quiz', [\App\Http\Controllers\QuizController::class, 'start']);
Route::post('/quiz/question1', [\App\Http\Controllers\QuizController::class, 'question1']);
Route::post('/quiz/question2', [\App\Http\Controllers\QuizController::class, 'question2']);
Route::post('/quiz/question3', [\App\Http\Controllers\QuizController::class, 'question3']);
Route::post('/quiz/question4', [\App\Http\Controllers\QuizController::class, 'question4']);
Route::post('/quiz/question5', [\App\Http\Controllers\QuizController::class, 'question5']);
Route::post('/quiz/finish', [\App\Http\Controllers\QuizController::class, 'finish']);
