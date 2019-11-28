@extends('layouts.app')

@section('content')

<!-- BASE PROFILE PAGE -->
<div class="container">
    <div class="row">
        <!-- LEFT COLUMN -->
        <div class="col-3 p-5">
            <!-- USER IMAGE -->
            <img 
            src="{{ $user->profile->profileImage() }}" 
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
            
                <div class="d-flex align-items-center pb-3">
                    <!-- USER NAME -->
                    <h1 class="h4">{{$user->username}}</h1>
    
                    <!-- FOLLOW/UNFOLLOW BUTTON VUE COMPONENT-->
                    <follow-button 
                        user-id="{{ $user->id }}" 
                        follows="{{ $follows }}"
                    >
                    </follow-button>
                </div>

                <!-- ADD NEW POST -->
                {{-- can directive for Adding a New Post only by the user --}}
                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan

            </div>

            <!-- EDIT PROFILE -->
            {{-- can directive for profile editing only by the user --}}
            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan

            <div class="d-flex">
                <!-- POSTS COUNT -->
                <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>

                <!-- FOLLOWERS -->
                <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>

                <!-- FOLLOWING -->
                <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
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
        {{-- LOOP THROUGH POSTS AND RENDER --}}
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
