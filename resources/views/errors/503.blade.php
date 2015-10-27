<!DOCTYPE html>
<html>

@section('title', 'We\'re currently down for maintenance')

@include('partials.header')

<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

<style>
    html, body {
        height: 100%;
    }

    body {
        margin: 0;
        padding: 0;
        width: 100%;
        color: #000;
        display: table;
        font-weight: 300;
        font-family: 'Lato';
    }

    .container {
        text-align: center;
        display: table-cell;
        vertical-align: middle;
    }

    .content {
        text-align: center;
        display: inline-block;
    }

    .content img {
        width: 50%;
        margin-bottom: 12px;
    }
</style>

<body>
<div class="container">
    <div class="content">
        <div>
            <img src="{{ asset('img/teachers-as-tutors-logo.png') }}" title="{{ env('APP_NAME') }}"
                 alt="{{ env('APP_NAME') }}">
        </div>

        <p>We're currently down for maintenance. For enquires please email <a
                    href="mailto:enquires@teachersastutors.org">enquires@teachersastutors.org</a>.</p>
    </div>
</div>
</body>
</html>