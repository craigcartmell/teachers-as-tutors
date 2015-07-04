@extends('app')

@section('title')
    {{ $page->name }})
@endsection

@section('hero')
    @include('partials.hero', ['hero_image_uri' => $page->hero_image_uri, 'hero_text' => $page->hero_text_formatted])
@overwrite

@section('content')
    <div class="container">

        <div class="row">
            <div class="{{ count($page->children) ? 'col-md-8' : '' }}">
                <h1>{{ $page->name }}</h1>

                {!! $page->content_formatted !!}
            </div>

            @if(count($page->children))
                <div class="col-md-4">
                    <h4>Recent</h4>

                    <ul>
                        @foreach($page->children as $child)
                            <li><a href="{{ $child->uri }}">{{ $child->name }}</a> <span class="text-muted">{{ $child->created_at->diffForHumans() }}</span></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

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