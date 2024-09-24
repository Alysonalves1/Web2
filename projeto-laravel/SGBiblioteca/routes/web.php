<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return redirect()->route('login'); 
});


Auth::routes(); 


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('users', UserController::class);

Route::resource('books', BookController::class)->middleware('auth'); 

Route::resource('authors', AuthorController::class)->middleware('auth'); 

Route::resource('categories', CategoryController::class)->middleware('auth'); 

Route::resource('publishers', PublisherController::class)->middleware('auth'); 
