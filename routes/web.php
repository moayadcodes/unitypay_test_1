<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;

// INSTRUCTIONS
Route::get('/', function () {
    return view('home.index');
})->name('home');

// COMPANIES
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/add', [CompanyController::class, 'add'])->name('companies.add');
Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
Route::patch('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
// TODO: Add routes for companies.show, companies.update, companies.show_users, companies.add_users here

// USERS
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/add', [UserController::class, 'add'])->name('users.add');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
