@extends('app')

@section('title', 'My Reports')

@section('breadcrumbs')
    {!! Breadcrumbs::render('reports') !!}
@endsection

@section('content')
    <div class="container table-responsive">
        @if(session('notification_sent'))
            <div class="alert alert-success">
                {{ session('notification_sent') }}
            </div>
        @endif
        @if(! auth()->user()->is_parent)
            <a href="{{ route('reports.add') }}" class="btn btn-primary">Add New</a>
        @endif
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Created</th>
                <th colspan="6">Updated</th>
            </tr>
            </thead>
            <tbody>
            @forelse($reports as $report)
                <tr>
                    <td>{{ $report->name }}</td>
                    <td>{{ $report->created_at->format('d/m/Y H:i:s') }}
                        by {{ $report->creator['name'] or 'System' }}</td>
                    <td>{{ $report->updated_at->format('d/m/Y H:i:s') }}
                        by {{ $report->updater['name'] or 'System' }}</td>
                    <td><a href="{{ route('reports.view', ['slug' => $report->slug]) }}" class="btn btn-default">View</a>
                    </td>
                    @if(! auth()->user()->is_parent)
                        <td><a href="{{ route('reports.notify', ['id' => $report->id]) }}" class="btn btn-default">Send
                                Parent Notification</a></td>
                        <td><a href="{{ route('reports.enable', ['id' => $report->id]) }}"
                               class="btn btn-default">{{ $report->is_enabled ? 'Disable' : 'Enable' }}</a></td>
                        <td><a href="{{ route('reports.edit', ['id' => $report->id]) }}" class="btn btn-default">Edit</a>
                        </td>
                        <td><a href="{{ route('reports.delete', ['id' => $report->id]) }}"
                               class="btn btn-danger delete-record">Delete</a></td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="10">There are currently no records available.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <!-- /container -->
@endsection