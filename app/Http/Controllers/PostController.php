<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    const MAX_POSTS_PER_PAGE = 5;

    /**
     * Gets all posts for home page
     */
    public function getIndex()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(self::MAX_POSTS_PER_PAGE);
        $params = [
            'posts' => $posts
        ];
        return view('post.index', $params);
    }

    /**
     * New - Create view page
     */
    public function getPostCreate()
    {
        return view('post.create');
    }

    /**
     * New - Create post action
     */
    public function postPostCreate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        // Validate user is logged in
        $user = Auth::user();
        if (!$user) {
            return redirect()->back();
        }

        // Creating post
        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        $user->posts()->save($post);
        $post->save();
        
        return redirect()->route('post.index')->with('info', 'Post created!');
    }

    /**
     * Edit - View post to edit
     */
    public function getPostEdit($id)
    {
        $post = Post::find($id);
        $params = [
            'post' => $post,
            'postId' => $id
        ];
        return view('post.edit', $params);
    }

    /**
     * Edit - Update post action
     */
    public function postPostUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);
        $post = Post::find($request->input('id'));
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect()->route('post.index')->with('info', 'Post edited!');
    }

    /**
     * Delete - Update post action
     */
    public function getPostDelete($id)
    {
        $post = Post::find($id);
        $post->comments()->delete();
        $post->likes()->delete();
        $post->delete();
        return redirect()->route('post.index')->with('info', 'Post deleted!');
    }

    /**
     * Likes - Adding likes to a post
     */
    public function getLikePost($id)
    {
        $post = Post::find($id);
        $like = new Like();
        $post->likes()->save($like);
        return redirect()->back();
    }
}
