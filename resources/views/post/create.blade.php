@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="container-fluid text-center">
        <div>
            <h1>Write your <b>Post</b> today!<h1>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="col-lg-5 control-label" for="name">Title:</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="title" placeholder="Enter a title" value="{{ old('title') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-5 control-label" for="description">Description:</label>
                <div class="col-lg-7">
                    <textarea class="form-control" rows="15" name="description" placeholder="Write a description for the post" value="{{ old('description') }}"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-5 control-label">Image:</label>
                <div class="col-lg-5">
                    <input type="file" name="image">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-5 control-label" for="community_id">Community:</label>
                @if(!count($communities) == 0)
                    <div class="col-lg-2">
                        <select class="form-control" name="community_id" id="community_id">
                            @foreach($communities as $community)
                                <option value="{{$community->id}}">{{$community->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                        <div class="text-left col-lg-3">
                            <a href="{{ route('community.create')}}">Create a community <b>first</b> here!</a>
                        </div>
                    
                    @endif
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <button type="submit" class="btn btn-default">Create</button>
            <a href="{{ route('home')}}">Cancel</a>
        </form>
    </div>
@endsection