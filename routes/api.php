<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServerController;


Route::post('login', [AuthController::class,'login']);
Route::middleware('auth:sanctum')->group(function(){
  Route::apiResource('servers', ServerController::class);
  Route::post('servers/bulk-delete', [ServerController::class,'bulkDelete']);
});
