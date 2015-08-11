<?php

Route::group(['prefix' => 'blog'], function(){
    Route::get('/', 'ArticlesController@index');
    Route::resource('articles', 'ArticlesController', ['only' => ['show']]);
    Route::get('tags/{tags}', 'TagsController@articles');
});

Route::group(['prefix' => 'admin'], function(){

    Route::get('/', 'AdminController@index');

    Route::group(['prefix' => 'users_control'], function(){
        Route::get('/', 'AdminController@usersControl');
        Route::resource('users', 'UsersController');
    });

    Route::group(['prefix' => 'articles_control'], function(){

        Route::get('delete/{id}', 'AdminController@deleteArticle');
        Route::get('/', 'AdminController@articlesControl');

        Route::resource('articles', 'ArticlesController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
        Route::get('restore/{id}', 'ArticlesController@restore');
    });

});



Route::resource('comments', 'CommentsController');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('/', 'PagesController@index');