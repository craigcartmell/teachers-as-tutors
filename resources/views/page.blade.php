@extends('app')

@section('title')
    {{ $page->name }}
@endsection

@section('hero_text', $page->hero_text)

@section('breadcrumbs')
    {!! Breadcrumbs::render('page', $page) !!}
@endsection

@section('content')
    <div class="container">

        @if($page->parent_id)
            <div>
                <span class="text-muted">Last updated {{ $page->updated_at->format('d/m/Y H:i:s') }} by {{ $page->creator->name or 'System' }}</span>
            </div>

            <br>
        @endif

        <div class="{{ isset($blog) && count($blog->children) ? 'row' : ''}}">
            <div class="{{ isset($blog) && count($blog->children) ? 'col-md-8' : '' }}">
                {!! $page->content_formatted !!}
            </div>

            @if(isset($blog) && count($blog->children))
                <div class="col-md-4 recent">
                    <h4>Recent Blog Posts</h4>

                    <ul class="list-group">
                        @foreach($blog->children->take(5) as $child)
                            <li class="list-group-item">
                                <a href="{{ $child->uri }}">{{ $child->name }}</a>
                                <span class="text-muted pull-right">{{ $child->updated_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                        <li class="list-group-item text-center"><a href="{{ url('blog') }}">See all posts</a></li>
                    </ul>
                </div>
            @endif

            @if(count($page->children))
                @foreach($page->children_paginated as $child)
                    <div>
                        <h3><a href="{{ url($child->uri) }}">{{ $child->name }}</a></h3>
                        <span class="text-muted">Last updated {{ $child->updated_at->format('d/m/Y H:i:s') }} by {{ $child->creator->name or 'System' }}</span>
                    </div>

                    <br>

                    {!! str_limit($child->content_formatted, 500, '...<a href="' . url($child->uri) . '">Read More</a>') !!}

                    <hr>
                @endforeach

                <div class="text-center">
                    {!! $page->children_paginated->render() !!}
                </div>
            @endif
        </div>

    </div>
    <!-- /container -->
@endsection