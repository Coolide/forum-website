@extends('layouts.app')

@section('title', "User - ".$user->username)

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
            <h1>See what's <b>{{$user->username}}</b> been upto!<h1>
        </div>

        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#posts_tab" data-toggle="tab">Posts</a>
            </li>
            <li>
                <a href="#comments_tab" data-toggle="tab">Comments</a>
            </li>
            <li>
                <a href="#likes_tab" data-toggle="tab">Likes</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="posts_tab">
                <div class="container-fuid">
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-md-6">
                                <div class="thumbnail">
                                    <a href="{{route('show.post', ['slug' => $post->slug])}}">
                                    <img class="images" src="/images/{{$post->file_path}}">
                                    <div class="caption">
                                        <p>{{$post->title}}<p>
                                        <a href="{{route('view.user', ['username'=> $user->username])}}"><span class="label label-info">By coolide</span></a>
                                        <span class="label label-default">3 Likes</span>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($posts->count() != 0)
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
                    @else
                    <div class="text-center">
                        <h4>...Wow, very quiet in here<h4>
                    </div>
                    @endif
                </div>
            </div>
            <div class="tab-pane" id="comments_tab">
                <p>This is the comments<p>
            </div>
            <div class="tab-pane" id="likes_tab">
                <p>This is the likes<p>
            </div>
        </div>
    </div>
@endsection