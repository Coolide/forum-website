@extends('layouts.app')

@section('title', 'Create Community')

@section('content')
    <div class="container-fluid text-center">
        <div>
            <h1>Start a <b>community</b> today!<h1>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('community.store') }}">
            @csrf
            <div class="form-group">
                <label class="col-lg-5 control-label" for="name">Name:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control" name="name" placeholder="Enter a community name!">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-5 control-label" for="description">Description:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control" name="description" placeholder="Write a description for the community.">
                </div>
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <button type="submit" class="btn btn-default">Create</button>
            <a href="{{ route('communities')}}">Cancel</a>
        </form>
    </div>
@endsection