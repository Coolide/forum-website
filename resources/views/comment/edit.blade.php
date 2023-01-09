@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="container-fluid text-center">
        <div class="row">
            <h1>Edit <b>Post</b><h1>
        </div>
        <div class="row">
            <form class="form-horizontal" method="POST" action="{{ route('update.comment', ['id' => $comment->id]) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <input class="form-control" rows="1" id="description" name="description" value="{{ $comment->description }}"></input>
                </div>
                <button type="submit" class="btn btn-default">Edit</button>
                <a href="{{ route('home')}}">Cancel</a>
            </form>
        </div>
    </div>
@endsection