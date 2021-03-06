@extends('app')

@section('title')
    {{ $page->exists ? 'Edit ' . $page->name : 'New Page' }}
@endsection

@section('css')
    <link href="{{ asset('build/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit-page', $page) !!}
@endsection

@section('content')
    <div class="container">
        @include('partials.errors')

        @if(session('success'))
            <div class="alert alert-success">The page was saved successfully.</div>
        @endif

        <form method="post">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name', $page->name) }}" class="form-control" placeholder="Example Page">
                </div>

                <div class="col-md-6">
                    <label for="parent_id">Parent Page (Optional)</label>
                    <select name="parent_id" class="form-control">
                        <option value="0">-- Please Select --</option>
                        @foreach($pages as $p)
                            <option value="{{ $p->getKey() }}" {{ $p->getKey() === $page->parent_id ? 'selected' : '' }}>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-6">
                    <label for="uri">Uri (Not including {{ url() }})</label>
                    <input type="text" name="uri" value="{{ old('uri', $page->uri) }}" class="form-control" placeholder="">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">
                    <label for="hero_text">Hero Text</label>
                    <textarea name="hero_text" data-provide="markdown" placeholder="Welcome to my page!" rows="10">{{ old('hero_text', $page->hero_text) }}</textarea>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">
                    <label for="content">Content</label>
                    <textarea name="content" data-provide="markdown" rows="30">{{ old('content', $page->content) }}</textarea>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">
                    <label for="is_enabled">Enabled</label>
                    <input type="checkbox" name="is_enabled" value="1" {{ $page->is_enabled ? 'checked' : '' }}>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" name="submit" value="Save" class="form-contol btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    <!-- /container -->
@endsection