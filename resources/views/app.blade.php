<!DOCTYPE html>
<html>
<head>
    <title>Teachers as Tutors - @yield('title')</title>

    <meta charset="UTF-8">
    <meta name="description" content="Tutors as Teachers">
    <meta name="keywords"
          content="teachers as tutors, teach, teachers, tutoring">
    <meta name="author" content="Teachers as Tutors">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    @yield('meta')

    <link href="{{ elixir('css/all.css') }}" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Alegreya:400italic,700italic,900italic,400,700,900'
          rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://www.google.com/recaptcha/api.js"></script>

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
            <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse pull-right">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url() }}">Home <span class="sr-only">(current)</span></a></li>
                <li><a href="{{ url('tuition') }}">Tuition <span class="sr-only">(current)</span></a></li>
                <li><a href="{{ url('tutors') }}">Tutors <span class="sr-only">(current)</span></a></li>
                <li><a href="{{ url('blog') }}">Blog <span class="sr-only">(current)</span></a></li>

                @if(auth()->check())
                    <li><a href="{{ route('logout') }}">Logout <span class="sr-only">(current)</span></a></li>
                @else
                    <li><a href="{{ route('login') }}">Login <span class="sr-only">(current)</span></a></li>
                @endif

            </ul>
        </div>
        <!--/.navbar-collapse -->
    </div>
</nav>

@section('hero')
    @include('partials.hero', ['hero_image_uri' => asset('img/heroes/hero_apple.jpg'), 'hero_text' => 'Default website intro.'])
@show

@yield('content')

<hr>

<div class="container">
    <footer>
        <p>&copy; {{ env('APP_NAME') }} {{ \Carbon\Carbon::now()->year }}</p>
    </footer>
</div>

<script src="{{ elixir('js/app.js') }}" type="text/javascript"></script>
</body>

</html>