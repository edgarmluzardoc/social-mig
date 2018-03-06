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
    // View comments
    // Route::get('/{postId}', [
    //     'uses' => 'CommentController@getIndex',
    //     'as' => 'comment.index'
    // ]);

    // Creating comments
    // Route::get('create', [
    //     'uses' => 'CommentController@getCommentCreate',
    //     'as' => 'comment.create'
    // ]);

    // Route::post('create', [
    //     'uses' => 'CommentController@postCommentCreate',
    //     'as' => 'comment.create'
    // ]);

    // Updating comments
    // Route::get('edit/{id}', [
    //     'uses' => 'CommentController@getCommentEdit',
    //     'as' => 'comment.edit'
    // ]);

    // Route::post('edit', [
    //     'uses' => 'CommentController@postCommentUpdate',
    //     'as' => 'comment.update'
    // ]);

    // Deleting comments
    // Route::get('delete/{id}', [
    //     'uses' => 'CommentController@getcommentDelete',
    //     'as' => 'comment.delete'
    // ]);
});
