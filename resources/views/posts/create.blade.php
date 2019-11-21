@extends('layouts.app')

@section('content')
<div class="container">
<!-- CREATE POST FORM -->
    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf

        <div class="row">
            <div class="col-8 offset-2">

                <h1>Add New Post</h1>
                
                <!-- CAPTION SECTION -->
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label ">Post Caption</label>
                        <input 
                            id="caption" 
                            type="text" 
                            class="form-control @error('caption') is-invalid @enderror"  
                            name="caption"
                            value="{{ old('caption') }}" 
                            required autocomplete="caption" 
                            autofocus
                        >

                        <!-- @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror -->

                        @if ($errors->has('caption'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('caption') }}</strong>
                            </span>
                        @endif
                </div>

                <!-- IMAGE SECTION -->
                <div class="row">
                    <label 
                        for="image" 
                        class="col-md-4 col-form-label"
                    >
                        Post Image
                    </label>

                    <input 
                        type="file" 
                        class="form-control-file" 
                        id="image"
                        name="image"
                    >

                    @if ($errors->has('image'))
                        <strong>{{ $errors->first('image') }}</strong>
                    @endif
                </div>

                <!-- BUTTON SECTION -->
                <div class="row pt-4">
                    <button class="btn btn-primary">Add New Post</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
