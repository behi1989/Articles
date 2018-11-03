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
Route::middleware('auth')->get('/panel/category', 'PanelController@category')->name('panel.category');
Route::middleware('auth')->get('/panel/users', 'PanelController@users')->name('panel.users');
Route::middleware('auth')->get('panel/{user}/deleteuser', 'PanelController@deleteuser')->name('panel.deleteuser');
Route::middleware('auth')->get('panel/{category}/editcategory', 'PanelController@editcategory')->name('panel.editcategory');
Route::patch('/panel/{category}', 'PanelController@update')->name('category.update');
Route::middleware('auth')->get('panel/{category}/deletecategory', 'PanelController@deletecategory')->name('panel.deletecategory');
Route::middleware('auth')->get('/article/{article}/delete', 'ArticleController@delete')->name('article.delete');
Route::middleware('auth')->get('/article/createcategory', 'ArticleController@createcategory')->name('article.createcategory');
Route::middleware('auth')->get('/category/create', 'CategoryController@create')->name('category.create');
Route::post('/category', 'CategoryController@store')->name('category.store');
Route::middleware('auth')->get('/panel/comment', 'CommentController@show')->name('panel.comment');
Route::middleware('auth')->get('/panel/{comment}/deletecomment', 'CommentController@deletecomment')->name('comment.deletecomment');
Route::middleware('auth')->get('panel/{comment}/activecomment', 'CommentController@activecomment')->name('comment.activecomment');
Route::get('/aboutus', 'HomeController@aboutus')->name('aboutus');
Route::get('/contactus', 'ContactusController@index')->name('contactus');
Route::post('/contactus', 'ContactusController@send')->name('contactus.send');
Route::middleware('auth')->get('/panel/contactus', 'ContactusController@showmessage')->name('panel.contactus');
Route::middleware('auth')->get('/panel/contactus/{id}/answermessage', 'ContactusController@answermessage')->name('panel.answermessage');
Route::patch('/panel/contactus/{contactus}', 'ContactusController@mailsending')->name('panel.sendemail');
Route::get('/search', 'ArticleController@search');