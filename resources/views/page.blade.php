@extends('app')

@section('title')
    {{ $page->name }})
@endsection

@section('hero')
    @include('partials.hero', ['hero_image_uri' => $page->hero_image_uri, 'hero_text' => $page->hero_text])
@overwrite

@section('content')
    <div class="container">
        <h1>{{ $page->name }}</h1>

        <p>
            {!! nl2br($page->content) !!}
        </p>
    </div>
    <!-- /container -->
@endsection