@extends('layouts.guest')

@section('title', 'Log in!')
@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <div class="container-fluid text-center">
        <div>
            <h1>Welcome to <b>Swansea Forums</b>!<h1>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label class="col-lg-5 control-label" for="email">Email:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-5 control-label" for="passowrd">Passowrd:</label>
                <div class="col-lg-2">
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" value="{{ old('password') }}">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Log in</button>
                <a href="{{ route('register') }}">Or register here!</a>
            </div>
        </form>
    </div>
@endsection