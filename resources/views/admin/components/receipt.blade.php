<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Receipt</title>
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
    <h1>Payment Receipt</h1>
  </header>

  <section>
    <h2>Received from:</h2>
    <p>{{ $receipt->invoice->first_name }} {{ $receipt->invoice->last_name }}</p>
    <p>{{ $receipt->invoice->country }}, {{ $receipt->invoice->province }}, {{ $receipt->invoice->city }}</p>
    <p>{{ $receipt->invoice->address }}</p>
    <p>{{ $receipt->invoice->postal_code }}</p>
  </section>

  <section>
    <h2>Payment Details:</h2>
    <p><strong>Receipt Number:</strong> {{ json_decode($receipt->receipt)->transaction_id }}</p>
    <p><strong>Payment Date:</strong> {{ date('d, F Y', strtotime($receipt->created_at)) }}</p>
    <p><strong>Payment Method:</strong> Transfer</p>
    <p><strong>Amount Received:</strong> @lang('currency.in_ID') {{ number_format($receipt->invoice->total, 2) }}</p>
  </section>

  <section>
    <h2>Transaction Summary:</h2>
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
            @foreach ((array) json_decode($receipt->invoice->orders) as $item)
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
    <h2>Total Amount Received: @lang('currency.in_ID') {{ number_format($receipt->invoice->total, 2) }}</h2>
  </section>

  <footer>
    <p>Thank you for your payment!</p>
  </footer>

</body>
</html>
