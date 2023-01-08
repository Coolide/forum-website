@extends('layouts.app')

@section('title', $community->name)

@section('content')
    <style>
        img {
            object-position: center;
            width: 400px;
            height: auto;
            aspect-ratio: 16/10;
        }
    </style>

    <div class="container">
        <div class="row text-center">
            <h1>You are viewing <b>{{$community->name}}</b>!</h1>
            <a href="{{route('view.user', ['username'=> $creator->username])}}"><span>Created by {{$creator->username}}</span></a>
        </div>
        <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-6">
                <div class="thumbnail">
                    <a href="{{route('show.post', ['slug' => $post->slug])}}">
                    <img class="images" src="/images/{{$post->file_path}}">
                    <div class="caption">
                        <p>{{$post->title}}<p>
                        <a href="{{route('view.user', ['username'=> $creator->username])}}"><span class="label label-info">By {{$creator->username}}</span></a>
                        <span class="label label-default">3 Likes</span>
                    </div>
                    </a>
                </div>
            </div>
        @endforeach
        </div>

        <div class="row">
            <div class="col-sm-4 text-center">
                <a href="{{ $posts->nextPageUrl()}}">Next page</a>
            </div>
            <div class="col-sm-4 text-center">
                <ul class="pagination">
                    @for($x = 1; $x <= $posts->lastPage(); $x++)
                        <li><a href="{{ $posts->url($x)}}">{{$x}}</a></li>
                    @endfor
                </ul>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ $posts->previousPageUrl()}}">Previous page</a>
            </div>

        </div>
    </div>
@endsection