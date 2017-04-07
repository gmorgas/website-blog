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

    <title>@yield('title')</title>
    <!-- Style -->
    <link rel="stylesheet" href="/css/app.css">
    <!-- JS -->
    <script type="text/javascript" src="/js/app.js"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{{ asset('img/favicons.png') }}}">

    @yield('script')
</head>
<body>
    <header>
        <a class="logo" href="/">
            <img src="/img/logomg.png" alt="GM" >
        </a>
    </header>
    <div class="navbar-menu" >
        <ul class="nav-menu">
            <li {{ ($action == env('APP_URL'))? 'class=ac' : '' }}><a {{ ($action == env('APP_URL'))? 'class=active' : '' }} href="@lang('route.about_me')">@lang('main.about_me')</a></li>
            <li {{ ($action == env('APP_URL').'/'.Lang::get('route.bee'))? 'class=ac' : '' }}><a {{ ($action == env('APP_URL').'/'.Lang::get('route.bee'))? 'class=active' : '' }} href="{{env('APP_URL').'/'}}@lang('route.bee')">@lang('main.bee')</a></li>
            <li {{ ($action == env('APP_URL').'/'.Lang::get('route.wine'))? 'class=ac' : '' }}><a {{ ($action == env('APP_URL').'/'.Lang::get('route.wine'))? 'class=active' : '' }} href="{{ env('APP_URL').'/' }}@lang('route.wine')">@lang('main.wine')</a></li>
            <li {{ ($action == env('APP_URL').'/'.Lang::get('route.cv'))? 'class=ac' : '' }}><a {{ ($action == env('APP_URL').'/'.Lang::get('route.cv'))? 'class=active' : '' }} href="{{ env('APP_URL').'/' }}@lang('route.cv')">@lang('main.cv')</a></li>
            <li {{ ($action == env('APP_URL').'/'.Lang::get('route.contact'))? 'class=ac' : '' }}><a {{ ($action == env('APP_URL').'/'.Lang::get('route.contact'))? 'class=active' : '' }} href="{{ env('APP_URL').'/' }}@lang('route.contact')">@lang('main.contact')</a></li>
        </ul>
        <button type="button" class="hamburger"></button>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <footer>
        @lang('main.footer')
    </footer>
</body>
</html>
