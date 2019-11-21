@extends('layouts.app')

@section('content')

<!-- BASE PROFILE PAGE -->
<div class="container">
    <div class="row">
        <!-- LEFT COLUMN -->
        <div class="col-3 p-5">
            <!-- USER IMAGE -->
            <img 
            src="/img/photography-of-mountain.jpg" 
            alt="My Logo"
            class="rounded-circle"
            style="width: 200px; height: 200px"
            >
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-9 pt-5" style="color: white;">
            <div 
            class=
                "d-flex 
                justify-content-between 
                align-items-baseline">
            
                <!-- USER NAME -->
                <h1>{{$user->username}}</h1>

                <!-- ADD NEW POST -->
                <a href="/p/create">Add New Post</a>
            </div>

            <!-- EDIT PROFILE -->
            <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>

            <div class="d-flex">
                <!-- POSTS COUNT -->
                <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>

                <!-- FOLLOWERS -->
                <div class="pr-5"><strong>23k</strong> followers</div>

                <!-- FOLLOWING -->
                <div class="pr-5"><strong>212</strong> followings</div>
            </div>

            <!-- PROFILE TITLE -->
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            
            <!-- PROFILE DESCRIPTION -->
            <div>{{ $user->profile->description }}</div>

            <!-- PROFILE URL -->
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div> 
    </div>

    <!-- CREATED POSTS from ADD NEW POSTS -->
    <div class="row pt-5"> 
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
         <a href="/p/{{ $post->id }}">
            <img src="/storage/{{ $post->image }}" alt="insta image" class="w-100">
         </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
