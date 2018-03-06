<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    const MAX_COMMENTS_PER_PAGE = 5;
    /**
     * Gets all comments for a post
     */
    public function getIndex($postId)
    {
        $post = Post::find($postId);
        $comments = $post->comments;
        $params = [
            'post' => $post,
            'comments' => $comments
        ];
        return view('comment.index', $params);
    }
}
