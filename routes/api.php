<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SignatureController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/documents', [DocumentController::class, 'upload']);
    Route::post('/signature-requests', [SignatureController::class, 'sendSignatureRequest']);
    Route::post('/signature-requests/{id}', [SignatureController::class, 'addSignature']);
});
