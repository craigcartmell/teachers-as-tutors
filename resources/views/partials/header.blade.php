<head>
    <title>{{ env('APP_NAME') }} - @yield('title')</title>

    <meta charset="UTF-8">
    <meta name="description" content="Tutors as Teachers">
    <meta name="keywords"
          content="teachers as tutors, teach, teachers, tutoring, tutors">
    <meta name="author" content="Teachers as Tutors">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="_token" content="{{ csrf_token() }}">

    @yield('meta')

    <link href="{{ elixir('css/all.css') }}" rel="stylesheet" type="text/css">

    @yield('css')

    <link href='http://fonts.googleapis.com/css?family=Alegreya:400italic,700italic,900italic,400,700,900'
          rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,300,400italic,700,700italic,900,900italic'
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