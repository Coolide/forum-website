@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="container-fluid text-center">
        <div>
            <h1>Edit <b>Post</b><h1>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('update.post', ['slug' => $post->slug]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="col-lg-5 control-label" for="name">Title:</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="title" placeholder="Enter a title" value="{{ $post->title }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-5 control-label" for="description">Description:</label>
                <div class="col-lg-7">
                    <textarea class="form-control" rows="15" name="description" placeholder="Write a description for the post">
                        {{$post->description}}
                    </textarea>
                </div>
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <button type="submit" class="btn btn-default">Edit</button>
            <a href="{{ route('home')}}">Cancel</a>
        </form>
    </div>
@endsection