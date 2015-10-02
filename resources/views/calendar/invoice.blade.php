<h1>Invoice for {{ $invoice_date->format('F Y') }}</h1>

<table>
    <thead>
    <tr>
        <th>Description</th>
        <th>Cost</th>
    </tr>
    </thead>

    <tbody>
    @foreach($lessons as $lesson)
        <tr>
            <td>{{ $lesson->started_at->format('l jS') }}</td>
        </tr>
        <tr>
            <td>Private tuition with {{ $lesson->tutor->name }} @ {{ $lesson->started_at->format('H:i') }}
            <td>{{ $lesson->hours }} hour(s) x £{{ $lesson->hourly_rate }} = £{{ $lesson->cost }}</td>

        </tr>
    @endforeach

    <tr>
        <td>
            Total
        </td>
        <td>
            £{{ $total }}
        </td>

    </tr>
    </tbody>
</table>
