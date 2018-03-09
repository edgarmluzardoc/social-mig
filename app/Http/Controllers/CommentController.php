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
        if (empty($post)) {
            return redirect()->route('post.index');
        }
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

        $post = Post::find($request->input('postId'));
        if (empty($post)) {
            return redirect()->route('post.index');
        }

        $user = Auth::user();
        $comment = new Comment([
            'content' => $request->input('content'),
            'user_id' => $user->id
        ]);

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

        $postId = $request->input('postId');
        $post = Post::find($postId);
        $comment = Comment::find($request->input('commentId'));

        if (empty($post) || !$this->canCommentAction($comment->user_id)) {
            return redirect()->route('post.index');
        }

        $comment->content = $request->input('content');
        $comment->save();
        
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
        if (empty($comment) || !$this->canCommentAction($comment->user_id)) {
            return redirect()->route('post.index');
        }
        $postId = $comment->post_id;
        $comment->delete();
        $params = [
            'postId' => $postId
        ];

        return redirect()->route('comment.index', $params)->with('info', 'Comment deleted!');
    }

    /**
     * Checks if the user logged in can action the URL
     */
    private function canCommentAction($commentUserId)
    {
        $user = Auth::user();
        return $user->id == $commentUserId;
    }
}
