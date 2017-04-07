<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('tag')">
    <meta name="robots" content="noodp">
    <meta name="robots" content="noydir">
    <meta name="author" content="Grzegorz Morgaś">
    <meta name="generator" content="Laravel">
    <meta name="revised" content="22.03.2017">

    <title>Grzegorz Morgaś</title>
    <!-- Style -->
    <link rel="stylesheet" href="/css/app.css">
    <!-- JS -->
    <script type="text/javascript" src="/js/app.js"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{{ asset('img/favicons.png') }}}">


</head>

<body>
<div class="content">
    <div class="row">
        <div class="col-md-10">
            <h1>Wszystkie posty</h1>
            <a href="{{ url('/logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                Logout
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ Lang::get('route.adminCreate') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Stwórz</a>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <th>#</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created At</th>
                <th></th>
                </thead>

                <tbody>

                @foreach ($posts as $post)

                    <tr>
                        <th>{{ $post->id }}</th>
                        <td>{{ $post->subject }}</td>
                        <td>{{ substr(unserialize($post->content), 0, 50) }} </td>
                        <td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
                        <td><a href="{{ route('show', $post->id) }}" class="btn btn-xs btn-primary">Pokaż</a>
                            {!! Form::open(['route' => ['delete', $post->id], 'method' => 'DELETE']) !!}

                            {!! Form::submit('Usuń', ['class' => 'btn btn-xs btn-danger']) !!}

                            {!! Form::close() !!}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>

            <div class="text-center">
                {!! $posts->links(); !!}
            </div>
        </div>
    </div>
</div>
</body>