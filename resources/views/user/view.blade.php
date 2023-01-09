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
                                        <span class="label label-default">{{$votes->where('votable_type', 'App\Models\Post')->where('votable_id', $post->id)->count()}} Likes</span>
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
                @foreach ($post->comments as $comment)
                    <div class="row">
                        <div class="media">
                            <a class="pull-left">
                                <img class="media-object img-circle" src="/default_pfp.png" style="width:60px; height:60px;">
                            </a>
                            <div class="media-body">
                                <h4><a href="{{route('view.user', ['username'=> $comment->username])}}"><b>{{$comment->username}}</b></a> <small><i>Posted on {{$comment->created_at}} | <b>{{$votes->where('votable_type', 'App\Models\Comment')->where('votable_id', $comment->id)->count()}} Likes</b></i></small></h4>
                                <p>{{$comment->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach   
            </div>
        </div>
    </div>
@endsection