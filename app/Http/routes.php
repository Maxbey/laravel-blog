<?php

Route::resource('articles', 'ArticlesController');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');