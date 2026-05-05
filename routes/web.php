<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRegistrationController;

Route::get('/', [UserRegistrationController::class, 'index'])->name('user.index'); 
Route::get('/create', [UserRegistrationController::class, 'create'])->name('user.create'); 
Route::post('/store', [UserRegistrationController::class, 'store'])->name('user.store'); 
Route::get('/edit/{id}', [UserRegistrationController::class, 'edit'])->name('user.edit'); 
Route::put('/update/{id}', [UserRegistrationController::class, 'update'])->name('user.update'); 
Route::delete('/delete/{id}', [UserRegistrationController::class, 'destroy'])->name('user.destroy');