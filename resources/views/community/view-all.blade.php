@extends('layouts.app')

@section('title', 'View Communities')

@section('content')
    <div class="container">
        <div class="row text-center">
            <h1>View all our <b>communities</b> today!<h1>
        </div>
        <div class="row">
            <ul>
                @foreach($communities as $communitiy)
                    <li>
                        <div class="panel panel-default">
                            <div class="panel-heading"><a href="{{route('show.community', ['slug'=> $communitiy->slug])}}"><h3>{{ $communitiy->name}}</h3></a></div>
                            <div class="panel-body"><h3><small>{{ $communitiy->description}}</small></h3></div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="row">
            <div class="col-sm-4 text-center">
                <a href="{{ $communities->nextPageUrl()}}">Next page</a>
            </div>
            <div class="col-sm-4 text-center">
                <ul class="pagination">
                    @for($x = 1; $x <= $communities->lastPage(); $x++)
                        <li><a href="{{ $communities->url($x)}}">{{$x}}</a></li>
                    @endfor
                </ul>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ $communities->previousPageUrl()}}">Previous page</a>
            </div>

        </div>
    </div>
@endsection