<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/show_all', [TodoController::class, 'showAll']);
Route::post('/show_by_id/{id}', [TodoController::class, 'showById']);
Route::post('/create_todo', [TodoController::class, 'createTodo']);
Route::put('/update_todo/{id}', [TodoController::class, 'updateTodo']);
Route::delete('/delete_todo/{id}', [TodoController::class, 'deleteTodo']);

