@extends('app')

@section('title', 'Admin - ' . $page->name)

@section('content')
    <div class="container">
        <h1>{{ $page->name }}</h1>

        @include('partials.errors')

        @if(session('success'))
            <div class="alert alert-success">The page was saved successfully.</div>
        @endif

        <form method="post">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-12">
                    <label for="name" class="label label-info">Name</label>
                    <input type="text" name="name" value="{{ old('name', $page->name) }}" class="form-control" placeholder="Example Page">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="uri" class="label label-info">Uri (Not including {{ url() }})</label>
                    <input type="text" name="uri" value="{{ old('uri', $page->uri) }}" class="form-control" placeholder="">
                </div>

                <div class="col-md-6">
                    <label for="hero_image_uri" class="label label-info">Hero Image Uri</label>
                    <input type="text" name="hero_image_uri" value="{{ old('hero_image_uri', $page->hero_image_uri) }}" class="form-control" placeholder="{{ asset('img/heroes/some_hero_image.jpg') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="hero_text" class="label label-info">Hero Text</label>
                    <input type="text" name="hero_text" value="{{ old('hero_text', $page->hero_text) }}" class="form-control" placeholder="Welcome to my page!">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="content" class="label label-info">Content</label>
                    <textarea name="content" class="form-control">{{ old('content', $page->content) }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="is_enabled" class="label label-info">Enable/Disable</label>
                    <select name="is_enabled">
                        <option value="0" class="form-control" {{ ! $page->is_enabled ? 'selected' : ''}}>Disabled</option>
                        <option value="1" class="form-control" {{ $page->is_enabled ? 'selected' : '' }}>Enabled</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" name="submit" value="Save" class="form-contol btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    <!-- /container -->
@endsection