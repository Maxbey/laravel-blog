<?php


Route::get('/', 'PagesController@index');

Route::group(['prefix' => 'im'], function(){
    Route::get('/', 'ProfileController@index');

    Route::post('comments/{id}', 'CommentsController@store');
    Route::resource('comments', 'CommentsController', ['only' => ['edit', 'update', 'destroy']]);
});

Route::group(['prefix' => 'auth'], function(){
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');

    Route::post('login', 'Auth\AuthController@postLogin');
    Route::post('register', 'Auth\AuthController@postRegister');
});

Route::group(['prefix' => 'blog'], function(){
    Route::get('/', 'ArticlesController@index');
    Route::resource('articles', 'ArticlesController', ['only' => ['show']]);
    Route::get('tags/{tags}', 'TagsController@articles');
});

Route::group(['prefix' => 'admin'], function(){

    Route::get('/', 'AdminController@index');

    Route::group(['prefix' => 'users_control'], function(){
        Route::get('/', 'AdminController@usersControl');

        Route::resource('users', 'UsersController', ['only' => ['create', 'store']]);
        Route::post('articles/restore/{id}', 'UsersController@restore');
    });

    Route::group(['prefix' => 'articles_control'], function(){
        Route::get('/', 'AdminController@articlesControl');

        Route::resource('articles', 'ArticlesController', ['only' => ['create', 'store', 'edit', 'update']]);
    });

});

Route::group(['prefix' => 'api'], function(){

    Route::group(['prefix' => 'articles'], function(){
        Route::get('/', 'ApiController@articles');
        Route::delete('delete/{id}', 'ArticlesController@destroy');
        Route::post('restore/{id}', 'ArticlesController@restore');
    });

});

