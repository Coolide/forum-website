@extends('layouts.guest')

@section('title', 'Register now!')
@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <div class="container-fluid text-center">
        <div>
            <h1>Start your journey in <b>Swansea Forums</b> today!<h1>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label class="col-lg-5 control-label" for="email">Username:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control" name="username" placeholder="Enter a username" value="{{ old('username') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-5 control-label" for="email">Email:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-5 control-label" for="passowrd">Passowrd:</label>
                <div class="col-lg-2">
                    <input type="password" class="form-control" name="password" placeholder="Enter your password">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-5 control-label" for="password_confirmation">Confirm Password:</label>
                <div class="col-lg-2">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm your password">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Register</button>
                <a href="{{ route('login') }}">Or login here!</a>
            </div>
        </form>
    </div>
@endsection