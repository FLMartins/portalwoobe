<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', ['as'=>'posts', 'uses'=>'PostController@posts']);
Route::post('/ajax/load', ['as'=>'ajax.load', 'uses'=>'PostController@ajaxLoad']);
/*
Route::get('/mail', ['as'=>'mail', 'uses'=>'EmailController@sendmail']);
Route::get('/mail/reset', function(){
	return view('mail.reset',['name'=>'John Newbie','mail'=>'willian.alfeu@gmail.com','password'=>'abc123']);
});
*/
Route::get('/categoria/{categoria_id}', ['as'=>'posts.categoria', 'uses'=>'PostController@categoria']);
Route::get('/login', ['as'=>'login', 'uses'=>'LoginController@login']);
Route::get('/login/password', ['as'=>'login.password', 'uses'=>'LoginController@passwordUpdate']);
Route::post('/login/password', ['as'=>'login.password.change', 'uses'=>'LoginController@doPasswordUpdate']);
Route::post('/login/facebook', ['as'=>'login.facebook', 'uses'=>'LoginController@facebook']);
Route::post('/login/authenticate', ['as'=>'login.authenticate', 'uses'=>'LoginController@authenticate']);
Route::get('/logout', ['as'=>'logout', 'uses'=>'LoginController@doLogout']);
Route::post('/logout', ['as'=>'logout', 'uses'=>'LoginController@doLogout']);
Route::group(['prefix'=>'admin'], function(){
	Route::get('/', ['as'=>'admin', 'uses'=>'AdminController@index']);
	Route::get('/user', ['as'=>'admin.user', 'uses'=>'AdminController@user']);
	Route::get('{id}/edit', ['as'=>'admin.edit', 'uses'=>'AdminController@edit']);
	Route::post('{id}/update', ['as'=>'admin.update', 'uses'=>'AdminController@update']);
	Route::post('/reset', ['as'=>'admin.reset', 'uses'=>'AdminController@reset']);
	Route::post('/save', ['as'=>'admin.save', 'uses'=>'AdminController@save']);
	Route::delete('/delete', ['as'=>'admin.delete', 'uses'=>'AdminController@delete']);
});
Route::group(['prefix'=>'post'], function(){
	Route::get('/add', ['as'=>'post.add', 'uses'=>'PostController@add']);
	Route::get('/edit', ['as'=>'post.edit', 'uses'=>'PostController@edit']);
	Route::post('/edit', ['as'=>'post.edit', 'uses'=>'PostController@edit']);
	Route::post('/active', ['as'=>'post.active', 'uses'=>'PostController@changeStatus']);
	Route::post('/save', ['as'=>'post.save', 'uses'=>'PostController@save']);
	Route::delete('/delete', ['as'=>'post.delete', 'uses'=>'PostController@delete']);
	Route::post('/update/{id}', ['as'=>'post.update', 'uses'=>'PostController@update']);
	Route::get('/{key}', ['as'=>'post', 'uses'=>'PostController@post']);
});
Route::group(['prefix'=>'categoria'], function(){
	Route::get('/', ['as'=>'categoria', 'uses'=>'CategoriaController@index']);
	Route::post('{id}/update', ['as'=>'categoria.update', 'uses'=>'CategoriaController@update']);
	Route::post('/save', ['as'=>'categoria.save', 'uses'=>'CategoriaController@save']);
	Route::delete('/delete', ['as'=>'categoria.delete', 'uses'=>'CategoriaController@delete']);
});
Route::group(['prefix'=>'galeria'], function(){
	Route::get('/', ['as'=>'galeria', 'uses'=>'UploadController@index']);
	Route::post('/upload', ['as'=>'galeria.upload', 'uses'=>'UploadController@upload']);
	Route::post('/ajax/upload', ['as'=>'galeria.ajax.upload', 'uses'=>'UploadController@ajaxUpload']);
	Route::post('/delete', ['as'=>'galeria.delete', 'uses'=>'UploadController@delete']);
});
Route::group(['prefix'=>'api'], function(){
	Route::post('/posts', ['as'=>'api.posts', 'uses'=>'ApiController@posts']);
	Route::post('/authors', ['as'=>'api.authors', 'uses'=>'ApiController@authors']);
	Route::post('/categories', ['as'=>'api.categories', 'uses'=>'ApiController@categories']);
	Route::post('/stats', ['as'=>'api.posts', 'uses'=>'ApiController@stats']);
});