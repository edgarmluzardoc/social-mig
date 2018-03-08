<?php

/**
 * Auth Routes
 */
Auth::routes();

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
    // View My Posts
    Route::get('myposts', [
        'uses' => 'PostController@getMyPosts',
        'as' => 'post.myposts'
    ]);

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

    // Adding Likes
    Route::get('post/{id}/like', [
        'uses' => 'PostController@getLikePost',
        'as' => 'post.like'
    ]);

    // Removing Likes
    Route::get('post/{postId}/unlike', [
        'uses' => 'PostController@getUnlikePost',
        'as' => 'post.unlike'
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

    // Updating comments
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

/**
 * Friend Routes
 */
Route::group(['prefix' => 'friends'], function() {
    // View friends
    Route::get('', [
        'uses' => 'FriendController@getIndex',
        'as' => 'friend.index'
    ]);

    Route::post('add', [
        'uses' => 'FriendController@postAddFriend',
        'as' => 'friend.add'
    ]);

    Route::post('remove', [
        'uses' => 'FriendController@postRemoveFriend',
        'as' => 'friend.remove'
    ]);
});