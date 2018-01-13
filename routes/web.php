<?php

Route::get('/', 'GuestController@index')->name('index');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('do-login');

Route::get('forgot-password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('forgot-password');
Route::post('forgot-password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('do-forgot-password');

Route::get('reset-password/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('reset-password', 'Auth\ResetPasswordController@reset')->name('password.request');

Route::get('user/register/{token}', 'Auth\RegisterController@getInvitedPage')->name('register.invited');
Route::post('user/register/save', 'Auth\RegisterController@saveUser')->name('register.save');

Route::group(['middleware' => ['auth']], function () {

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('in-active', 'HomeController@getInactivePage')->name('inactive');

    /**
     * These routes are available only for activated users.
     */
    Route::group(['middleware' => ['user.status']], function () {
        Route::get('home', 'HomeController@index')->name('home');
        Route::get('profile', 'ProfileController@index')->name('profile');

        /*Invite routes*/
        Route::get('invite', 'InviteController@index')->name('invite');
        Route::get('invite/add', 'InviteController@create')->name('invite.add');
        Route::post('invite/add', 'InviteController@store')->name('invite.save');

        /*Conversation routes*/
        Route::get('conversations', 'ConversationController@index')->name('conversation.list');
        Route::get('conversations/{slug}', 'ConversationController@view')->name('conversation.view');
    });
});