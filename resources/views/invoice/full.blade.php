<!DOCTYPE html>
<html>
<head>
    <title>{{ env('APP_NAME') }} - Invoice for {{ $invoice_date->format('F Y') }}</title>

    <meta charset="UTF-8">
    <meta name="description" content="Tutors as Teachers">
    <meta name="keywords"
          content="teachers as tutors, teach, teachers, tutoring, tutors">
    <meta name="author" content="Teachers as Tutors">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="_token" content="{{ csrf_token() }}">

    <link href="{{ elixir('css/all.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
    <h1 class="text-center">Invoice for {{ $invoice_date->format('F Y') }}</h1>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

                <h4>FROM</h4>

                <p>{{ env('APP_NAME') }}</p>

                <p>{{ env('INVOICE_ADDRESS1') }}</p>

                <p>{{ env('INVOICE_ADDRESS2') }}</p>

                <p>{{ env('INVOICE_ADDRESS3') }}</p>

                <p>{{ env('INVOICE_ADDRESS4') }}</p>

                <p>{{ env('INVOICE_POSTCODE') }}</p>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <h4>TO</h4>

                <p>{{ $parent->name }}</p>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <h4>&nbsp;</h4>

                <p>Invoice No: {{ $invoice_no }}</p>

                <p>Invoice Date: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>

                <p>VAT No: {{ $vat_no }}</p>

                <p>Company No: {{ $company_no }}</p>
            </div>
        </div>
    </div>


    <table class="table table-responsive">
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
</div>

</body>
</html>