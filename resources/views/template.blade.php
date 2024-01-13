<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <title>Document</title>
</head>
<body>
<style>
    li{
        padding: 10px;
    }
</style>
<div style="display: inline-flex">
    @if(Gate::allows('admin'))
<nav class="sidebar">
    <div id="content" style="margin:20px;" class="container-fluid">
        <ul class="navbar-nav">
            <li ><a href="{{route("allocation.index")}}">Allocation</a></li>
            @if(\Illuminate\Support\Facades\Auth::check())
                <li><a href="/logout">Logout</a></li>
            @endif
            <li><a href="{{route('classrooms.index')}}">Manage Classroom</a></li>
            <li><a >Manage Lecturer</a></li>
            <li><a href="{{route('student.index')}}">Manage Students</a></li>
            <li><a href="{{route('subject.index')}}">Manage Subjects</a></li>
        </ul>

    </div>
</nav>
    @endif
        @if(Gate::allows('student'))
    <nav class="sidebar">
        <div id="content" style="margin:20px;" class="container-fluid">
            <ul class="navbar-nav">
                <li ><a href="{{route("allocation.index")}}">Courses</a></li>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <li><a href="/logout">Logout</a></li>
                @endif
                <li><a href="{{route('classrooms.index')}}">Forum</a></li>
                <li><a href="{{route('student.index')}}">Schedule</a></li>
            </ul>

        </div>
    </nav>
        @endif
<div style="margin-top: 20px" class="content">
    @yield('content')
</div>
</div>
</body>
</html>
