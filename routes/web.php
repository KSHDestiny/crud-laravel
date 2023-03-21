<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('create');
// })->name("create#page");

// Route::get('/read', function () {
//     return view('read');
// })->name("read");

// Create Page
Route::get('/',[CustomerController::class,'createPage'])->name("create#page");

// Create
Route::post('/create',[CustomerController::class,'create'])->name("create");

// Read Page
Route::get('/read',[CustomerController::class,'readPage'])->name("read");

// Update Page
Route::get('/updatePage/{id}',[CustomerController::class,'updatePage'])->name("update#page");

// Update
Route::post('/update/{id}',[CustomerController::class,'update'])->name("update");

// Delete
Route::get('/delete/{id}',[CustomerController::class,'delete'])->name("delete");
