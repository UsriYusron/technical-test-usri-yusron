<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\NilaiRtController;
use App\Http\Controllers\NilaiStController;
use App\Http\Controllers\EmployeesController;

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

// route login tamu
Route::middleware('guest')->post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // route to divisi
    Route::get('/divisions', [DivisiController::class, 'index']);

    // Employee
    Route::get('/employees', [EmployeesController::class, 'index']); // GET
    Route::post('/employees', [EmployeesController::class, 'store']); //CREATE
    Route::put('/employees/{id}', [EmployeesController::class, 'update']);  //UPDATE 
    Route::delete('/employees/{id}', [EmployeesController::class, 'delete']); // DELETE

    // logout
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

});


Route::middleware('guest')->group(function () {
    // route soal tambahan
    Route::get('/nilaiRT', [NilaiRtController::class, 'index']); // GET NILAI RT
    Route::get('/nilaiST', [NilaiStController::class, 'index']); // GET NILAI ST
});

