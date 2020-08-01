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
        $user = Auth::user();
        if ($user) {
            // Getting user's friend ids
            $friendIds = [];
            foreach ($user->friends as $friend) {
                $friendIds[] = $friend->friend_id;
            }

            $publicPosts = $posts = Post::where('privacy', 'public');
            $friendPosts = $posts = Post::where('privacy', 'friends')->whereIn('user_id', $friendIds);
            $privatePosts = $posts = Post::where('user_id', $user->id);

            $posts = $publicPosts->union($friendPosts)->union($privatePosts)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $posts = Post::where('privacy', 'public')->orderBy('created_at', 'desc')->paginate(self::MAX_POSTS_PER_PAGE);
        }
        
        $params = [
            'posts' => $posts
        ];
        return view('post.index', $params);
    }

    /**
     * Gets all posts for logged in user
     */
    public function getMyPosts()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(self::MAX_POSTS_PER_PAGE);
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

        // Creating post
        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'privacy' => $request->input('optPrivacy')
        ]);

        $user = Auth::user();
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
        if (empty($post) || !$this->canPostAction($post->user_id)) {
            return redirect()->route('post.index');
        }
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
        if (empty($post) || !$this->canPostAction($post->user_id)) {
            return redirect()->route('post.index');
        }
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->privacy = $request->input('optPrivacy');
        $post->save();
        return redirect()->route('post.index')->with('info', 'Post edited!');
    }

    /**
     * Delete - Update post action
     */
    public function getPostDelete($id)
    {
        $post = Post::find($id);
        if (empty($post) || !$this->canPostAction($post->user_id)) {
            return redirect()->route('post.index');
        }
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
        if (empty($post)) {
            return redirect()->route('post.index');
        }
        $like = new Like([
            'user_id' => Auth::user()->id
        ]);
        $post->likes()->save($like);
        return redirect()->back();
    }

    /**
     * Likes - Removing likes to a post
     */
    public function getUnlikePost($postId)
    {
        $post = Post::find($postId);
        if (empty($post)) {
            return redirect()->route('post.index');
        }
        $like = Like::where('user_id', Auth::user()->id)->where('post_id', $postId)->first();
        $like->delete();
        return redirect()->back();
    }

    /**
     * Checks if the user logged in can action the URL
     */
    private function canPostAction($postUserId)
    {
        $user = Auth::user();
        return $user->id == $postUserId;
    }
}
