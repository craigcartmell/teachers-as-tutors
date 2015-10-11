<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 800px;
            margin-bottom: 10px;
        }

        td {
            width: 33%;
        }

        th {
            text-align: left;
        }

        h1 {
            width: 100%;
        }
    </style>
</head>

<body>
<table>
    <tbody>
    <tr>
        <th colspan="3"><h1>Invoice for {{ $invoice_date->format('F Y') }}</h1></th>
    </tr>
    <tr>
        <td><h4>FROM</h4></td>
        <td><h4>TO</h4></td>
        <td><h4>&nbsp;</h4></td>
    </tr>
    <tr>
        <td>{{ env('APP_NAME') }}</td>
        <td>{{ $parent->name }}</td>
        <td>Invoice No: {{ $invoice_no }}</td>
    </tr>
    <tr>
        <td>{{ env('INVOICE_ADDRESS1') }}</td>
        <td>&nbsp;</td>
        <td>Invoice Date: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
    </tr>

    <tr>
        <td>{{ env('INVOICE_ADDRESS2') }}</td>
        <td>&nbsp;</td>
        <td>VAT No: {{ $vat_no }}</td>
    </tr>

    <tr>
        <td>{{ env('INVOICE_ADDRESS3') }}</td>
        <td>&nbsp;</td>
        <td>Company No: {{ $company_no }}</td>
    </tr>

    <tr>
        <td>{{ env('INVOICE_ADDRESS4') }}</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td>{{ env('INVOICE_POSTCODE') }}</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>

    </tbody>
</table>

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
            <td>Private tuition with {{ $lesson->tutor->name }} on {{ $lesson->started_at->format('d/m/Y @ H:i') }}
            <td>{{ $lesson->hours }} hour(s) x {{ $lesson->hourly_rate }}
                = {{ number_format($lesson->cost,2) }}</td>
        </tr>
    @endforeach

    @if($is_vat_charged)
        <tr>
            <td>
                <h3>Sub Total (GBP)</h3>
            </td>
            <td>
                <h3>{{ number_format($sub_total,2) }}</h3>
            </td>
        </tr>

        <tr>
            <td>
                <h3>{{ $vat_perc }}% VAT (GBP)</h3>
            </td>
            <td>
                <h3>{{ number_format($vat,2) }}</h3>
            </td>
        </tr>
    @endif

    <tr>
        <td>
            <h3>Total (GBP)</h3>
        </td>
        <td>
            <h3>{{ number_format($total,2) }}</h3>
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>