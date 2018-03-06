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

/**
 * Home Routes
 */
Route::get('/', [
    'uses' => 'PostController@getIndex',
    'as' => 'post.index'
]);


/**
 * Post Routes
 */
Route::group(['prefix' => 'post'], function() {
    // Creating posts
    Route::get('create', [
        'uses' => 'PostController@getPostCreate',
        'as' => 'post.create'
    ]);

    Route::post('create', [
        'uses' => 'PostController@postPostCreate',
        'as' => 'post.create'
    ]);

    // Updating posts
    Route::get('edit/{id}', [
        'uses' => 'PostController@getPostEdit',
        'as' => 'post.edit'
    ]);

    Route::post('edit', [
        'uses' => 'PostController@postPostUpdate',
        'as' => 'post.update'
    ]);

    // Deleting posts
    Route::get('delete/{id}', [
        'uses' => 'PostController@getPostDelete',
        'as' => 'post.delete'
    ]);
});

/**
 * Comment Routes
 */
Route::get('/comments/post/{postId}', [
    'uses' => 'CommentController@getIndex',
    'as' => 'comment.index'
]);

Route::group(['prefix' => 'comment'], function() {
    // Creating comments
    Route::post('create', [
        'uses' => 'CommentController@postCommentCreate',
        'as' => 'comment.create'
    ]);

    Route::post('edit', [
        'uses' => 'CommentController@postCommentUpdate',
        'as' => 'comment.update'
    ]);

    // Deleting comments
    Route::get('delete/{commentId}', [
        'uses' => 'CommentController@getCommentDelete',
        'as' => 'comment.delete'
    ]);
});
