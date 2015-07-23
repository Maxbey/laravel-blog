<?php

Route::resource('blog', 'ArticlesController');
Route::resource('comments', 'CommentsController');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');

Route::get('/', 'PagesController@index');

Route::get('tag/{tags}', 'TagsController@articles');