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

Route::get('/', 'ArticleController@index');
Route::middleware('auth')->get('/article/create', 'ArticleController@create')->name('article.create');
Route::post('/article', 'ArticleController@store')->name('article.store');
Route::get('/article/{article}', 'ArticleController@show')->name('article.show');
Route::middleware('auth')->get('/article/{article}/edit', 'ArticleController@edit')->name('article.edit');
Route::patch('/article/{article}', 'ArticleController@update')->name('article.update');
Route::post('/article/{article}/comment', 'CommentController@store')->name('comment.store');
Route::get('/article/category/{category}', 'CategoryController@index')->name('category.index');
Route::middleware('auth')->get('/panel/index', 'PanelController@index')->name('panel.index');