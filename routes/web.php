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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function(){
    return view('admin.dashboard');
})->middleware(['auth', 'admin'])->name('dashboard');

Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function(){
    Route::resource('/users', 'UserController')->except(['create', 'show', 'store']);
    Route::resource('/articles', 'ArticleController')->except(['create', 'show']);
});


Route::get('/index', function(){
    return view('pages.index');
});
Route::get('/contact', function(){
    return view('pages.contact');
});
Route::get('/about', function(){
    return view('pages.about');
});
Route::get('/fashion', function(){
    return view('pages.fashion');
});
Route::get('/travel', function(){
    return view('pages.travel');
});
Route::get('/single', function(){
    return view('pages.single');
});