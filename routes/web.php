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

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::any('/admin_dashboard', 'HomeController@admin_index')->name('admin.dashboard');
    Route::any('/consultant_dashboard', 'HomeController@consultant_index')->name('consultant.dashboard');
    Route::get('/user_dashboard', 'HomeController@user_index')->name('user.dashboard');

    Route::any('/admin_question', 'HomeController@admin_question')->name('admin.question');
    Route::any('/consultant_question', 'HomeController@consultant_question')->name('consultant.question');
    Route::any('/user_question', 'HomeController@user_question')->name('user.question');

    Route::post('/create_question', 'QuestionController@create')->name('question.create');
    Route::get('/delete_question/{id}', 'QuestionController@create')->name('question.delete');
    Route::get('/close_question/{id}', 'QuestionController@create')->name('question.close');
    Route::post('/get_question_data', 'QuestionController@get_question_data')->name('get_question_data');
    Route::post('/reply_question', 'QuestionController@reply')->name('question.reply');


    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::post('/updateuser', 'UserController@updateuser')->name('updateuser');
    Route::get('/user/index', 'UserController@index')->name('user.index');
    Route::post('/user/create', 'UserController@create')->name('user.create');
    Route::post('/user/edit', 'UserController@edituser')->name('user.edit');
    Route::get('/user/delete/{id}', 'UserController@delete')->name('user.delete');


