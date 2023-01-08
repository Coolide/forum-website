@extends('layouts.app')

@section('title', 'Swansea Forums')

@section('content')
<style>
        img {
            object-position: center;
            width: auto;
            height: auto;
            aspect-ratio: 16/10;
        }
</style>
    <div class="container">
        <div class="row text-center">
            <h1>Welcome to <b>Swansea Forums!</b><h1>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Recent Posts</div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row">
                                @foreach ($posts as $post)
                                    <div class="col-md-6">
                                        <div class="thumbnail">
                                            <a href="{{route('show.post', ['slug' => $post->slug])}}">
                                            <img class="images" src="/images/{{$post->file_path}}">
                                            <div class="caption">
                                                <p>{{$post->title}}<p>
                                                <a href="{{route('view.user', ['username'=> $post->username])}}"><span class="label label-info">By {{$post->username}}</span></a>
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
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Browse Communities</div>
                    <div class="panel-body">
                        <ul>
                            @foreach($communities as $community)
                                <li><h3><a href="{{route('show.community', ['slug' => $community->slug])}}"><b>{{$community->name}}</b></a></h3></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection