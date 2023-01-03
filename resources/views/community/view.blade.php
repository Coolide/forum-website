@extends('layouts.app')

@section('title', 'View Communities')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>View all our <b>communities</b> today!<h1>
        </div>
        <ul>
            @foreach($communities as $communitiy)
                <li>
                    <div class="panel panel-default">
                        <div class="panel-heading"><a href="#"><h3>{{ $communitiy->name}}</h3></a></div>
                        <div class="panel-body"><h3><small>{{ $communitiy->description}}</small></h3></div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{$communities->lastPage() }}
        <div>
            <a href="{{ $communities->nextPageUrl()}}">Next page</a>
            <a href="{{ $communities->previousPageUrl()}}">Previous page</a>
        </div>
    </div>
@endsection