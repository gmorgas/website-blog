!DOCTYPE html>
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

    @yield('script')
</head>
<body>
<header>
    <a class="logo" href="/">
        <img src="/img/logomg.png" alt="GM" >
    </a>
</header>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="hero-unit center">
                    <h1>Oops coś poszło nie tak <small><font face="Tahoma">Error 503</font></small></h1>
                    <br />
                    <p>Wystąpił błąd lub trwają prace. Wracamy niedługo.</p>
                    <p><b>Jeśli problem wystepuje dalej proszę o kontakt na: gmorgas@grzegorzmorgas.pl</b></p>
                    <a href="/" class="btn btn-large btn-info"><i class="icon-home icon-white"></i>Strona główna</a>
                </div>

            </div>
        </div>
    </div>

</div>
<footer>
    @lang('main.footer')
</footer>
</body>
</html>