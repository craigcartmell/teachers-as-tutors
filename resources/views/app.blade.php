<!DOCTYPE html>
<html>

@include('partials.header')

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
            <a class="navbar-brand logo" href="{{ url('') }}"><img src="{{ asset('img/teachers-as-tutors-logo.png') }}"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse pull-right">
            <ul class="nav navbar-nav">
                <li class="{{ url() === Request::url() ? 'active' : '' }}"><a href="{{ url() }}">Home <span
                                class="sr-only">(current)</span></a>
                </li>
                <li class="{{ url('philosophy') === Request::url() ? 'active' : '' }}"><a
                            href="{{ url('philosophy') }}">Our Philosophy
                        <span class="sr-only">(current)</span></a></li>
                <li class="{{ url('tuition') === Request::url() ? 'active' : '' }}"><a href="{{ url('tuition') }}">Private
                        Tuition
                        <span class="sr-only">(current)</span></a></li>
                <li class="{{ url('tutors') === Request::url() ? 'active' : '' }}"><a href="{{ url('tutors') }}">Tutors
                        <span class="sr-only">(current)</span></a></li>
                <!--<li class="{{ url('blog') === Request::url() ? 'active' : '' }}"><a href="{{ url('blog') }}">Blog <span
                                class="sr-only">(current)</span></a></li>-->
                <li class="{{ url('contact') === Request::url() ? 'active' : '' }}"><a href="{{ url('contact') }}">Contact <span
                                class="sr-only">(current)</span></a></li>

                @if(auth()->check())
                    <li>
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="true">
                            <span class="glyphicon glyphicon-user"></span> {{ auth()->user()->name_short }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{ route('profile') }}">My Profile</a></li>
                            <li><a href="{{ route('reports') }}">My Reports</a></li>
                            <li><a href="{{ route('calendar') }}">My Calendar</a></li>
                            @if(auth()->user()->is_admin || auth()->user()->is_tutor)
                                <li><a href="{{ route('resources') }}">Resources</a></li>
                            @endif
                            @if(auth()->user()->is_admin)
                                <li class="nav-divider"></li>
                                <li><a href="{{ route('admin.maintenance') }}">Turn Maintenance
                                        Mode {{ app()->isDownForMaintenance() ? 'Off' : 'On' }}</a></li>
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
                <img src="{{ asset('img/heroes/hero_portrait.jpg') }}" alt="{{ env('APP_NAME') }}">

                <div class="carousel-caption">
                    @yield('hero_text')
                </div>
            </div>
            <!-- TODO: Uncomment -->
            <!--<div class="item">
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
            </div>-->
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
                    href="mailto:craigcartmell1@gmail.com" target="_blank">Craig Cartmell</a></p>
    </footer>
</div>

<script src="{{ elixir('js/app.js') }}" type="text/javascript"></script>

@yield('scripts')

</body>

</html>