<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;
use Auth;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function getIndex()
    {
        $friendIds = Friend::select('friend_id')->where('user_id', '=', Auth::user()->id);
        if (!empty($friendIds)) {
            $users = User::where('id', '!=', Auth::user()->id)
            ->whereNotIn('id', $friendIds)
            ->orderBy('users.name', 'asc')->get();
        } else {
            $users = User::where('id', '!=', Auth::user()->id)
            ->orderBy('users.name', 'asc')->get();
        }

        $userWithFriends = User::find(Auth::user()->id);
        $friends = $userWithFriends->friends;
        $params = [
            'users' => $users,
            'friends' => $friends
        ];
        return view('friends.index', $params);
    }

    public function postAddFriend(Request $request)
    {
        if (empty($request->input('users'))) {
            return redirect()->route('friend.index');
        }

        $user = Auth::user();
        foreach ($request->input('users') as $friendIdToAdd) {
            // Adding main friendship
            $userToAdd = User::find($friendIdToAdd);
            $friend = new Friend([
                'user_id' => $user->id,
                'friend_id' => $friendIdToAdd,
                'name' => $userToAdd->name
            ]);
            $user->friends()->save($friend);

            // Adding reverse friendship
            $userAdded = User::find($friendIdToAdd);
            $friend = new Friend([
                'user_id' => $userAdded->id,
                'friend_id' => $user->id,
                'name' => $user->name
            ]);
            $userAdded->friends()->save($friend);
        }
        return redirect()->route('friend.index')->with('info', 'Friends added!');
    }

    public function postRemoveFriend(Request $request)
    {
        if (empty($request->input('friends'))) {
            return redirect()->route('friend.index');
        }

        $user = Auth::user();
        foreach ($request->input('friends') as $friendIdToRemove) {
            // Removing reverse friendship
            $friendData = Friend::where('id', $friendIdToRemove)->first(['user_id', 'friend_id']);
            $reverseIdToRemove = Friend::select('id')
                ->where('user_id', $friendData->friend_id)
                ->where('friend_id', $friendData->user_id)
                ->first();
            $friendToRemove = Friend::find($reverseIdToRemove->id);
            $friendToRemove->delete();

            // Removing main friendship
            $friendToRemove = Friend::find($friendIdToRemove);
            $friendToRemove->delete();
        }

        return redirect()->route('friend.index')->with('info', 'Friends removed!');
    }
}
