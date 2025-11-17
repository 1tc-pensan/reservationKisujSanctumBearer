<?php

use App\Http\Controllers\Api\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
//nyilvános
Route::get('/hello', function (Request $request) {
    return response()->json(['message'=>'Hello API']);
});
Route::post('/register',[AuthController::class,'Register']); //regisztráció
Route::post('/login',[AuthController::class,'Login']); //regisztráció


//jogosított
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',[AuthController::class,'Logout']); //kijelentkezés
});
Route::get('/reservations',[ReservationController::class, 'index']); // összes foglalás
Route::get('/reservations/{id}',[ReservationController::class, 'show']); // egy foglalás
Route::post('/reservations',[ReservationController::class, 'store']); // egy foglalás rögzítése
Route::put('/reservations/{id}',[ReservationController::class, 'update']); // egy foglalás minden mezőjét módosítom
Route::patch('/reservations/{id}',[ReservationController::class, 'update']); // egy foglalás néhány mezőjét módosítom
Route::delete('/reservations/{id}',[ReservationController::class, 'destroy']); // egy foglalás törlése
