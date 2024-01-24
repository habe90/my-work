<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Faktura #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header,
        .footer {
            text-align: center;
            margin-top: 30px;
        }

        .header h1 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Faktura #{{ $invoice->id }}</h1>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Opis</th>
                    <th>Količina</th>
                    <th>Cijena</th>
                    <th>Ukupno</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->successfulJobs as $job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        @if ($job->completion_date instanceof \Carbon\Carbon)
                            <td>{{ $job->completion_date->format('d.m.Y') }}</td>
                        @else
                            <td>{{ $job->completion_date }}</td> <!-- Ili neki defaultni prikaz -->
                        @endif

                        <td>{{ $job->amount_due }} KM</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-right">Ukupno:</td>
                    <td>{{ number_format($invoice->successfulJobs->sum('amount_due'), 2) }} KM</td>
                </tr>
                
            </tbody>
        </table>

        <div class="footer">
            <p>Zahvaljujemo se na vašem poslovanju!</p>
        </div>
    </div>
</body>

</html>
