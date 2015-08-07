<?php

Route::group(['prefix' => 'blog'], function(){
    Route::resource('articles', 'ArticlesController');
});

Route::resource('comments', 'CommentsController');
Route::resource('users', 'UsersController');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('/', 'PagesController@index');

Route::get('tag/{tags}', 'TagsController@articles');