@extends('layouts.app')

<!-- SHOW A POST THAT WAS CREATED -->
@section('content')
<div class="container">
    <div class="row">
        <!-- LEFT COLUMN -->
        <div class="col-8">
            <!-- POST IMAGE -->
            <img src="/storage/{{ $post->image }}" alt="post img" class="w-100">
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <!-- PROFILE IMAGE -->
                        <img 
                            src="{{ $post->user->profile->profileImage() }}" 
                            alt="profile image" 
                            class="rounded-circle w-100"
                            style="max-width: 40px"
                        >
                    </div>
    
                    <div>
                        <!-- POST USERNAME -->
                        <div 
                            class="font-weight-bold"> 
                            <a href="/profile/{{ $post->user->id }}">
                                {{ $post->user->username }}
                            </a>

                            <!-- FOLLOW/UNFOLLOW BUTTON -->
                            <a href="#" class="pl-3">Follow</a>
                        </div>
                    </div>
                </div>

                <hr>
                
                <!-- POST CAPTION -->
                <p> 
                    <span 
                        class="font-weight-bold"> 
                        <a href="/profile/{{ $post->user->id }}">
                            {{ $post->user->username }}
                        </a>
                    </span>
                    {{ $post->caption }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
