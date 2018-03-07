<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Auth;
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

    /**
     * New - Create comment action
     */
    public function postCommentCreate(Request $request)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        // Validate user is logged in
        $user = Auth::user();
        if (!$user) {
            return redirect()->back();
        }

        $comment = new Comment([
            'content' => $request->input('content'),
            'user_id' => Auth::user()->id
        ]);

        $post = Post::find($request->input('postId'));
        $post->comments()->save($comment);
        $user->comments()->save($comment);

        $params = [
            'postId' => $post->id
        ];

        return redirect()->route('comment.index', $params)->with('info', 'Comment created!');
    }

    /**
     * Edit - View comment to edit
     */
    public function postCommentUpdate(Request $request)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $comment = Comment::find($request->input('commentId'));
        $comment->content = $request->input('content');
        $comment->save();

        $postId = $request->input('postId');
        $params = [
            'postId' => $postId
        ];

        return redirect()->route('comment.index', $params)->with('info', 'Comment updated!');
    }

    /**
     * Delete - Update comment action
     */
    public function getCommentDelete($commentId)
    {
        $comment = Comment::find($commentId);
        $postId = $comment->post_id;
        $comment->delete();
        $params = [
            'postId' => $postId
        ];

        return redirect()->route('comment.index', $params)->with('info', 'Comment deleted!');
    }
}
