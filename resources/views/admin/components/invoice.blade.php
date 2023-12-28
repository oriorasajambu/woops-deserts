    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - #{{ sprintf('%07d', $invoice->id) }}</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        }

        header {
        text-align: center;
        background-color: #f2f2f2;
        padding: 10px;
        }

        section {
        margin-top: 20px;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        }

        th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        }

        th {
        background-color: #f2f2f2;
        }

        footer {
        margin-top: 20px;
        text-align: center;
        }
    </style>
    </head>
    <body>

    <header>
        <h1>Invoice</h1>
    </header>

        <section>
            <h2>Bill To:</h2>
            <p>{{ $invoice->first_name }} {{ $invoice->last_name }}</p>
            <p>{{ $invoice->country }}, {{ $invoice->province }}, {{ $invoice->city }}</p>
            <p>{{ $invoice->address }}</p>
            <p>{{ $invoice->postal_code }}</p>
        </section>

    <section>
        <h2>Invoice Details:</h2>
        <p><strong>Invoice Number:</strong> #{{ sprintf('%07d', $invoice->id) }}</p>
        <p><strong>Invoice Date:</strong> {{ date('d, F Y', strtotime($invoice->created_at)) }}</p>
    </section>

    <section>
        <h2>Products/Services:</h2>
        <table>
        <thead>
            <tr>
            <th>Description</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ((array) json_decode($invoice->orders) as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>@lang('currency.in_ID') {{ number_format($item->associatedModel->price, 2) }}</td>
                    <td>@lang('currency.in_ID') {{ number_format(($item->associatedModel->price * $item->quantity), 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </section>

    <section>
        <h2>Sub Total: @lang('currency.in_ID') {{ number_format($invoice->sub_total, 2) }}</h2>
        <h2>Tax: @lang('currency.in_ID') {{ number_format($invoice->tax ?? 0, 2) }}</h2>
        <h2>Total Amount:  @lang('currency.in_ID') {{ number_format($invoice->total, 2) }}</h2>
    </section>

    <footer>
        <p>Thank you for your business!</p>
    </footer>

    </body>
    </html>