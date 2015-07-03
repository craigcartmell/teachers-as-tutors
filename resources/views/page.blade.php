@extends('app')

@section('title')
    {{ $page->name }})
@endsection

@section('hero')
    @include('partials.hero', ['hero_image_uri' => $page->hero_image_uri, 'hero_text' => $page->hero_text_formatted])
@overwrite

@section('content')
    <div class="container">
        <h1>{{ $page->name }}</h1>

        {!! $page->content_formatted !!}

        @if(count($page->children))
            @foreach($page->children as $child)
                <h3>{{ $child->name }}</h3>
                <span class="pull-right text-muted">Posted {{ $child->created_at->format('d/m/Y H:i:s') }} by {{ $child->creator->name }}</span>

                {!! $child->content_formatted !!}
                <hr>
            @endforeach
        @endif
    </div>
    <!-- /container -->
@endsection