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
            <!-- USER NAME -->
            <h3>{{ $post->user->username }}</h3>
            
            <!-- POST CAPTION -->
            <p>{{ $post->caption }}</p>
        </div>
    </div>
</div>
@endsection
