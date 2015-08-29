@extends('app')

@section('title', $report->name)

@section('breadcrumbs')
    {!! Breadcrumbs::render('view-report', $report) !!}
@endsection

@section('content')
    <div class="container">
        <div>
            <span class="text-muted">Last updated {{ $report->updated_at->format('d/m/Y H:i:s') }} by {{ $report->creator->name or 'System' }}</span>
        </div>

        <br>

        {!! $report->report_formatted !!}
    </div>
@endsection