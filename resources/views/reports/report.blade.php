@extends('app')

@section('title', $report->name)

@section('breadcrumbs')
    {!! Breadcrumbs::render('view-report', $report) !!}
@endsection

@section('content')
    <div class="container">
        {!! $report->report_formatted !!}
    </div>
    <!-- /container -->
@endsection