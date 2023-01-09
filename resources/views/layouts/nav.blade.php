<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    .navbar {
        margin-bottom: 0;
        border-radius: 0;
        position: fixed;
    }
</style>

<body>
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>   
            <span class="icon-bar"></span>                     
        </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <li><a href="{{ route('home')}}">Home</a></li>
            <li><a href="{{ route('communities')}}">Communities</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">Create
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{route('post.create')}}">Post</a></li>
                    <li><a href="{{route('community.create')}}">Community</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if(!empty(Auth::user()->username))
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">Notifications
                    @if(App\Models\Notification::where('user_id', Auth::user()->id)->count() > 0)
                        <span class="badge">{{ App\Models\Notification::where('user_id', Auth::user()->id)->count() }}</span>
                    @endif
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    @foreach (App\Models\Notification::where('user_id', Auth::user()->id)->get() as $notification)
                        <li><a>{{$notification->description}}</a></li>
                    @endforeach
                </ul>
            </li>
                <li><a href="{{route('view.user', ['username'=> Auth::user()->username])}}">{{ Auth::user()->username }}</a></li>
                <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
            @else
                <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
            @endif

        </ul>
        </div>
    </div>
    </nav>
</body>
</html>