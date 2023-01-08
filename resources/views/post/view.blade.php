@extends('layouts.app')

@section('title', 'View Post')

@section('content')
    <style>
        img {
            object-position: center;
            width: 50%;
            height: auto;
            aspect-ratio: 16/10;
            }
        .top-buffer { margin-top:20px; }
        .bottom-buffer {margin-bottom:20px;}
    </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <div class="container">
        <div class="row text-center">
            <h1><b>{{$post->title}}</b></h1>
            by <a href="{{route('view.user', ['username'=> $creator->username])}}"><span class="label label-info">{{$creator->username}}<span></a>
            in <a href="{{route('show.community', ['slug' => $community->slug])}}"><span class="label label-primary">{{$community->name}}</span></a>

        </div>
        <div class="row top-buffer">
            <img class="rounded mx-auto d-block" src="/images/{{$post->file_path}}">
        </div>
        <div class="row text-center">
            <p><h3>{{$post->description}}<h3><p>
        </div>
        <div class="row bottom-buffer">
            <form class="form-horizontal" method="POST" action="{{ route('comment.store') }}">
                @csrf
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="1" id="description" name="description" value="{{ old('description') }}"></textarea>
                </div>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <button type="submit" class="btn btn-default">Comment</button>
            </form>
        </div>
        @foreach ($post->comments as $comment)
        <div class="row">
            <div class="media">
                <a class="pull-left">
                    <img class="media-object img-circle" src="/default_pfp.png" style="width:60px; height:60px;">
                </a>
                <div class="media-body">
                    <h4><b>{{$comment->username}}</b> <small><i>Posted on {{$comment->created_at}}</i></small></h4>
                    <p>{{$comment->description}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection