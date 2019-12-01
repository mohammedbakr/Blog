<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// Check if Auth hasRole Admin, Auther or User
Route::get('/admin', function(){
    return view('admin.dashboard');
})->middleware(['auth', 'admin'])->name('dashboard');

// AdminLTE Dashboard
Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function(){
    Route::resource('/users', 'UserController')->except(['create', 'show', 'store']);
    Route::resource('/articles', 'ArticleController')->except(['create', 'show']);
});

// User Pages
Route::namespace('Pages')->name('pages.')->group(function(){
    Route::resource('/index', 'ArticlesController')->except(['create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/tags', 'TagsController')->only(['show']);
    Route::post('/comments/{id}', 'CommentsController@store')->name('comments.store');
});


Route::get('/contact', function(){
    return view('pages.contact');
})->name('contact');
Route::get('/about', function(){
    return view('pages.about');
})->name('about');