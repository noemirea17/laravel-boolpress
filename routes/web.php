<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('guest-home');
Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts{slug}', 'PostController@show')->name('posts.show');

Auth::routes();

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('admin-home');
        Route::get('/profile', 'HomeController@profile')->name('admin-profile');
        Route::post('/profile/generate-token', 'HomeController@generateToken')->name('admin.generate_token');
        Route::resource('/posts', PostController::Class)->names([

            'index' => 'admin.posts.index',
            'show' => 'admin.posts.show',
            'create' => 'admin.posts.create',
            'edit' => 'admin.posts.edit',
            'update' => 'admin.posts.update',
            'store' => 'admin.posts.store',
            'destroy' => 'admin.posts.destroy'
        ]);
});

// Route::get('/admin', 'HomeController@index')->name('admin-home')->middleware('auth');

// Route::resource('/posts', 'PostsController');


