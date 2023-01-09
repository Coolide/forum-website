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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" /> 
        
    <div class="container">
        <div class="row text-center">
            <h1><b>{{$post->title}}</b></h1>
            by <a href="{{route('view.user', ['username' => $creator->username])}}"><span class="label label-info">{{$creator->username}}<span></a>
            in <a href="{{route('show.community', ['slug' => $community->slug])}}"><span class="label label-primary">{{$community->name}}</span></a>

        </div>
        <div class="row top-buffer">
            <img class="rounded mx-auto d-block" src="/images/{{$post->file_path}}">
        </div>
        <div class="row text-center">
            <p><h3>{{$post->description}}<h3><p>
        </div>
        @if(!empty(Auth::user()->username))
            <div class="row bottom-buffer">
                <div class="btn-group">
                    <div class="btn-group">
                        <form method="POST" action="{{ route('like') }}">
                            @csrf
                            <label class="text-muted"><b>{{$votes->where('votable_type', 'App\Models\Post')->where('votable_id', $post->id)->count()}} Likes</b></label>
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                            <input type="hidden" name="username" value="{{ Auth::user()->username}}">
                            <input type="hidden" name="vote_type" value="post">
                            <button type="submit" class="btn btn-default "><span class="glyphicon glyphicon-thumbs-up"></span></button>
                        </form>
                    </div>
                    @if (Auth::user()->id == $creator->id || Auth::user()->id == $community->user_id || Auth::user()->is_admin)
                    <div class="btn-group">
                        <a href= "{{route('edit.post', ['slug'=>$post->slug])}}"><button type="button" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></button></a>
                    </div>
                    @endif
                    @if (Auth::user()->id == $creator->id || Auth::user()->is_admin)
                    <div class="btn-group">
                        <form method="POST" action="{{route('delete.post', ['slug'=>$post->slug])}}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        @endif
        <div class="row bottom-buffer">
            <form id="comment_form" class="form-horizontal" method="POST" action="{{route('comment.store')}}">
                @csrf
                @if(!empty(Auth::user()->username))
                <input type="hidden" name="user_id" id="ajax_user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="post_id" id="ajax_post_id" value="{{ $post->id }}">
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="1" id="ajax_description_id" name="description" value="{{ old('description') }}"></textarea>
                </div>
                <button type="submit" class="btn btn-default ajax-button">Comment</button>
                @else
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control disabled" rows="1" id="ajax_description_id" name="description" value="{{ old('description') }}"></textarea>
                </div>
                <button type="submit" class="btn btn-default disabled">Comment</button>
                @endif
            </form>
        </div>
        @foreach ($post->comments as $comment)
        <div class="row">
            <div class="media">
                <a class="pull-left">
                    <img class="media-object img-circle" src="/default_pfp.png" style="width:60px; height:60px;">
                </a>
                <div class="media-body">
                    <h4><a href="{{route('view.user', ['username'=> $creator->username])}}"><b>{{$comment->username}}</b></a> <small><i>Posted on {{$comment->created_at}} | <b>{{$votes->where('votable_type', 'App\Models\Comment')->where('votable_id', $comment->id)->count()}} Likes</b></i></small></h4>
                    <p>{{$comment->description}}</p>
                    <div class="btn-group">
                @if(!empty(Auth::user()->username))
                    <div class="btn-group">
                        <form method="POST" action="{{ route('like') }}">
                            @csrf
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="username" value="{{ Auth::user()->username }}">
                            <input type="hidden" name="vote_type" value="comment">
                            <button type="submit" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-thumbs-up"></span></button>
                        </form>
                    </div>
                    @if (Auth::user()->id == $comment->user_id || Auth::user()->id == $community->user_id || Auth::user()->is_admin)
                    <div class="btn-group">
                        <a href="{{route('edit.comment', ['id'=>$comment->id])}}"><button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span></button></a>
                    </div>
                    @endif
                    @if (Auth::user()->id == $comment->user_id || Auth::user()->is_admin)
                        <div class="btn-group">
                            <form method="POST" action="{{route('delete.comment', ['id'=>$comment->id])}}">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            $(".ajax-button").click(function(e){
                e.preventDefault();

                var user_id = $("#ajax_user_id").val();
                var post_id = $("#ajax_post_id").val();
                var description = $("#ajax_description_id").val();

                $.ajax({
                    url: "{{route('comment.store')}}",
                    type:'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{
                        user_id:user_id,
                        post_id:post_id,
                        description:description
                    }
                });

                $(document).ajaxStop(function(){
                    window.location.reload();
                });
            });
    </script>
@endsection