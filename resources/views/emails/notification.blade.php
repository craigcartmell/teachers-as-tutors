<p>Hi {{ $report->parent->name }},</p>

<p>{{ $report->creator->name }} has sent a notification regarding {{ $report->name }}.</p>

<p>To view the report, please <a href="{{ route('reports.view', ['slug' => $report->slug]) }}">click here</a>.</p>

<p>Regards,</p>

<p>{{ env('APP_NAME') }}</p>