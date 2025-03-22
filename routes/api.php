<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\FolderController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::put('profile', [AuthController::class, 'update']);

    Route::get('/notes',[NoteController::class,'index']);
    Route::post('/notes',[NoteController::class,'store']);
    Route::get('/notes/{slug}',[NoteController::class,'show']);
    Route::put('/notes/{id}',[NoteController::class,'update']);
    Route::patch('/notes/{id}',[NoteController::class,'makeAsFavorite']);
    Route::patch('/notes-pin/{id}',[NoteController::class,'pin']);
    Route::delete('/notes/{id}',[NoteController::class,'destroy']);

    Route::get('/folders',[FolderController::class,'index']);
    Route::post('/folders',[FolderController::class,'store']);
    Route::put('/folders/{id}',[FolderController::class,'update']);
    Route::delete('/folders/{id}',[FolderController::class,'destroy']);


});
