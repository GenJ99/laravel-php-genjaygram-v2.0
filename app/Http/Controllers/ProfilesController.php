<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        // CHECK FOLLOWING/UNFOLLOWING STATUS
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        // POST COUNT CACHE
        $postCount = Cache::remember(
            // KEY
            'count.posts.' . $user->id,
            // TIME
            now()->addSeconds(30),
            // CALLBACK
            function () use ($user) {
                return $user->posts->count();
            }
        );

        // FOLLOWERS COUNT CACHE
        $followersCount = Cache::remember(
            // KEY
            'count.posts.' . $user->id,
            // TIME
            now()->addSeconds(30),
            // CALLBACK
            function () use ($user) {
                return $user->profile->followers->count();
            }
        );

        // FOLLOWING COUNT CACHE
        $followingCount = Cache::remember(
            // KEY
            'count.posts.' . $user->id,
            // TIME
            now()->addSeconds(30),
            // CALLBACK
            function () use ($user) {
                return $user->following->count();
            }
        );

        return view('profiles.index', compact(
            'user',
            'follows',
            'postCount',
            'followersCount',
            'followingCount'
        ));
    }

    public function edit(User $user)
    {
        //AUTHORIZE UPDATE POLICY
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        // AUTHORIZE UPDATE POLICY
        $this->authorize('update', $user->profile);

        // DATA VALIDATION
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        // CONDITIONAL STATEMENT FOR IMAGE
        // If state allows the current image to be used if the image isn't changed
        // during Editing Profile.
        if (request('image')) {
            // Image is stored to $imagePath variable, as the store() method sends it to 
            // a profile directory, and a local directory(public). ** Look into using this 
            // with Amazon s3.
            $imagePath = request('image')->store('profile', 'public');

            //IMAGE RESIZING
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        // UPDATE PROFILE
        auth()->user()->profile->update(array_merge(
            //ARRAY MERGE UPDATE IMAGE
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}
