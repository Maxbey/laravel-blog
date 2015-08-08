<?php

Route::group(['prefix' => 'blog'], function(){
    Route::resource('articles', 'ArticlesController');
    Route::get('tags/{tags}', 'TagsController@articles');
});

Route::group(['prefix' => 'admin'], function(){
    Route::resource('users', 'UsersController');
});

Route::resource('comments', 'CommentsController');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('/', 'PagesController@index');