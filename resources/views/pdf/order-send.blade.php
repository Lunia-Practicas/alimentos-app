<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedido {{$order->order_num}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .order-details {
            margin-bottom: 20px;
        }
        .terms, .note-section {
            font-size: 0.9em;
        }
        .details-row {
            margin-bottom: 20px;
        }
        .details-col {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .order-details {
            margin-bottom: 20px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="order-details">
    <h2>Hola {{$order->email}}. Aquí se adjunta su pedido</h2>
    <div class="company-details">
        <img src="{{ $message->embed(public_path('img/logo.jpg')) }}" alt="logo" height="100" width="100">
        <h2>{{$company['name']}}</h2>
        <p>{{$company['direction']}}</p>
        <p>Teléfono: {{$company['contact']}}</p>
        <p>Email: {{$company['email']}}</p>
    </div>
</div>

</body>
</html>
