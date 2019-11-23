<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    // Constructor sends user to login page upon typing url route if not sigined in.
    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {
        // DATA VALIDATION
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        // Image is stored to $imagePath variable, as the store() method sends it to a uploads directory,
        // and a local directory(public). ** Look into using this with Amazon s3.
        $imagePath = request('image')->store('uploads', 'public');

        // IMAGE RESIZING
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image-> save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        // REDIRECT TO PROFILE
        return redirect('/profile/' . auth()->user()->id);
    }

    // SHOW A POST
    public function show(\App\Post $post) {
        return view('posts.show', compact('post'));
    }
}
