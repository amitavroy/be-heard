<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('conversations/save', 'ConversationController@store')->name('conversation.save');
    Route::post('conversation/reply/save', 'ConversationController@conversationReply')->name('conversation.reply');
    Route::post('comment/get', 'ConversationController@getCommentById');
    Route::post('comment/update', 'ConversationController@updateCommentById')->name('comment.update');
});