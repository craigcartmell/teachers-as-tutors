@extends('app')

@section('title')
    {{ $report->exists ? 'Edit ' . $report->name : 'New Report' }}
@endsection

@section('css')
    <link href="{{ asset('build/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit-report', $report) !!}
@endsection

@section('content')
    <div class="container">
        @include('partials.errors')

        @if(session('success'))
            <div class="alert alert-success">The report was saved successfully.</div>
        @endif

        <form method="post">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name', $report->name) }}" class="form-control" placeholder="Progress Report for...">
                </div>

                <div class="col-md-6">
                    <label for="parent_id">Assign to Parent</label>
                    <select name="parent_id" class="form-control">
                        <option value="0">-- Please Select --</option>
                        @foreach($parents as $p)
                            <option value="{{ $p->getKey() }}" {{ $p->getKey() === $report->parent_id ? 'selected' : '' }}>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">
                    <label for="report">Report</label>
                    <textarea name="report" data-provide="markdown" placeholder="" rows="10">{{ old('hero_text', $report->report) }}</textarea>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-6">
                    <label for="is_enabled">Enabled</label>
                    <input type="checkbox" name="is_enabled" value="1" {{ $report->is_enabled ? 'checked' : '' }}>
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