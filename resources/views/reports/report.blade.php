@extends('app')

@section('title')
    {{ $report->name }}
@endsection

@section('content')
    <div class="container">
        {!! $report->report_formatted !!}
    </div>
    <!-- /container -->
@endsection