<!DOCTYPE html>
<html>

<head>
    <title>Cashflow Report - {{ $monthName }} {{ $year }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 10px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f9f8f6;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            text-transform: uppercase;
            font-size: 8px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .text-right {
            text-align: right;
        }

        .income {
            color: green;
        }

        .expense {
            color: red;
        }

        .summary {
            margin-top: 30px;
            width: 300px;
            float: right;
        }

        .summary table td {
            border: none;
            padding: 5px;
        }

        .total {
            font-weight: bold;
            border-top: 1px solid #000 !important;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Cashflow Report</h2>
        <p>{{ $monthName }} {{ $year }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Type</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $item)
                <tr>
                    <td>{{ $item->date->format('d M Y') }}</td>
                    <td>{{ $item->description }}</td>
                    <td style="text-transform: uppercase;">{{ $item->type }}</td>
                    <td class="text-right {{ $item->type == 'expense' ? 'expense' : '' }}">
                        {{ $item->type == 'expense' ? '-' : '' }} IDR {{ number_format($item->amount, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <table>
            <tr>
                <td>Total Income</td>
                <td class="text-right">IDR {{ number_format($totalIncome, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Expense</td>
                <td class="text-right">- IDR {{ number_format($totalExpense, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td><strong>Balance</strong></td>
                <td class="text-right"><strong>IDR {{ number_format($balance, 0, ',', '.') }}</strong></td>
            </tr>
            </tbody>
        </table>
</body>

</html>
