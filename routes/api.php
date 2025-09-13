<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ServerController;


Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login'])->name('login');
Route::middleware('auth:sanctum')->group(function(){
  Route::post('logout', [AuthController::class, 'logout']);
  Route::apiResource('servers', ServerController::class);
  Route::post('servers/bulk-delete', [ServerController::class,'bulkDelete']);
  Route::post('servers/bulk-update-status', [ServerController::class, 'bulkUpdateStatus']);

  
});
