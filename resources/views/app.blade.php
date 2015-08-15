<!DOCTYPE html>
<html>
<head>
    <title>{{ env('APP_NAME') }} - @yield('title')</title>

    <meta charset="UTF-8">
    <meta name="description" content="Tutors as Teachers">
    <meta name="keywords"
          content="teachers as tutors, teach, teachers, tutoring, tutors">
    <meta name="author" content="Teachers as Tutors">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    @yield('meta')

    <link href="{{ elixir('css/all.css') }}" rel="stylesheet" type="text/css">

    @yield('css')


    <link href='http://fonts.googleapis.com/css?family=Alegreya:400italic,700italic,900italic,400,700,900'
          rel='stylesheet' type='text/css'>

    @if(app()->environment() === 'production')
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                            (i[r].q = i[r].q || []).push(arguments)
                        }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', '{{ env('GA_ID') }}', 'auto');
            ga('send', 'pageview');
        </script>

        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', '{{ env('GA_ID') }}']);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>
    @endif
</head>
<body data-site-url="{{ url() }}">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('') }}">{{ env('APP_NAME') }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse pull-right">
            <ul class="nav navbar-nav">
                <li class="{{ url() === Request::url() ? 'active' : '' }}"><a href="{{ url() }}">Home <span
                                class="sr-only">(current)</span></a>
                </li>
                <li class="{{ url('tuition') === Request::url() ? 'active' : '' }}"><a href="{{ url('tuition') }}">Tuition
                        <span class="sr-only">(current)</span></a></li>
                <li class="{{ url('tutors') === Request::url() ? 'active' : '' }}"><a href="{{ url('tutors') }}">Tutors
                        <span class="sr-only">(current)</span></a></li>
                <li class="{{ url('blog') === Request::url() ? 'active' : '' }}"><a href="{{ url('blog') }}">Blog <span
                                class="sr-only">(current)</span></a></li>
                <li class="{{ url('contact') === Request::url() ? 'active' : '' }}"><a href="{{ url('contact') }}">Contact <span
                                class="sr-only">(current)</span></a></li>

                @if(auth()->check())
                    <li>
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="true">
                            Welcome {{ auth()->user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{ route('profile') }}">My Profile</a></li>
                            @if(auth()->user()->is_admin || auth()->user()->is_tutor)
                                <li><a href="{{ route('reports') }}">My Reports</a></li>
                                <li><a href="{{ route('calendar') }}">My Calendar</a></li>
                                <li><a href="{{ route('resources') }}">Resources</a></li>
                            @endif
                            @if(auth()->user()->is_admin)
                                <li class="nav-divider"></li>
                                <li><a href="{{ route('admin.pages') }}">Manage Pages</a></li>
                                <li><a href="{{ route('admin.users') }}">Manage Users</a></li>
                            @endif
                            <li class="nav-divider"></li>
                            <li><a href="{{ route('logout') }}">Logout <span class="sr-only">(current)</span></a></li>
                        </ul>
                    </li>
                @else
                    <li class="{{ route('login') === Request::url() ? 'active' : '' }}"><a href="{{ route('login') }}">Login
                            <span class="sr-only">(current)</span></a></li>
                @endif

            </ul>
        </div>
        <!--/.navbar-collapse -->
    </div>
</nav>

@section('hero')
    <div id="carousel-hero" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <!--<ol class="carousel-indicators">
            <li data-target="#carousel-hero" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-hero" data-slide-to="1"></li>
            <li data-target="#carousel-hero" data-slide-to="2"></li>
        </ol>-->

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{ asset('img/heroes/hero_apple.jpg') }}" alt="{{ env('APP_NAME') }}">

                <div class="carousel-caption">
                    @yield('hero_text')
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('img/heroes/hero_child_studying.jpg') }}" alt="{{ env('APP_NAME') }}">

                <div class="carousel-caption">
                    @yield('hero_text')
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('img/heroes/hero_scribe.jpg') }}" alt="{{ env('APP_NAME') }}">

                <div class="carousel-caption">
                    @yield('hero_text')
                </div>
            </div>
        </div>
    </div>
@show

<div class="container">
    <div>
        @yield('breadcrumbs')
    </div>
</div>

<div class="container">
    <h1>@yield('title')</h1>
</div>

@yield('content')

<hr>

<div class="container">
    <footer>
        <p class="text-center">&copy; {{ env('APP_NAME') }} {{ \Carbon\Carbon::now()->year }} - Created by <a
                    href="http://www.three-oh.com" target="_blank">Three Oh</a></p>
    </footer>
</div>

<script src="{{ elixir('js/app.js') }}" type="text/javascript"></script>
</body>

</html>