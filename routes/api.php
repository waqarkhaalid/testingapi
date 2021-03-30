<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\NotesController;

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


Route::get('get-users', [UsersController::class, 'index']);
Route::post('create-user', [UsersController::class, 'store']);
Route::put('update-user/{id}', [UsersController::class, 'update']);
Route::delete('delete-user/{id}', [UsersController::class, 'destroy']);
Route::post('login', [UsersController::class, 'login']);

Route::get('get-notes', [NotesController::class, 'index']);
Route::post('create-note', [NotesController::class, 'store']);
Route::put('update-note/{id}', [NotesController::class, 'update']);
Route::delete('delete-note/{id}', [NotesController::class, 'destroy']);
Route::put('mark-note/{id}', [NotesController::class, 'mark_note']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
