<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('auth:api')->group(function () {
  Route::get('/notes', [NoteController::class, 'index']);
  Route::post('/notes', [NoteController::class, 'store']);
  Route::get('/notes/{id}', [NoteController::class, 'show']);
  Route::put('/notes/{id}', [NoteController::class, 'update']);
  Route::delete('/notes/{id}', [NoteController::class, 'destroy']);
  Route::get('/notes', [NoteController::class, 'mostrar']);
  Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});
