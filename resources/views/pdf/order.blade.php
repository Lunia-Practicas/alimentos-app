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
    </style>
</head>
<body>
<div class="container">
    <!-- Company Details -->
    <div class="row details-row">
        <div class="col-md-6 details-col text-end">
            <img src="{{ public_path('img/logo.jpg') }}" alt="logo" height="100" width="100">
            <h2>{{$company['name']}}</h2>
            <p>{{$company['direction']}}</p>
            <p>Teléfono: {{$company['contact']}}</p>
            <p>Email: {{$company['email']}}</p>
        </div>
        <div class="col-md-6 details-col">
            <h2>Datos del Cliente</h2>
            <p><strong>Nombre:</strong> </p>
            <p><strong>Email:</strong> {{$order->email}}</p>
            <p><strong>Dirección:</strong></p>
        </div>

    </div>

    <!-- Order Details -->
    <div class="order-details">
        <h2>Número de pedido: {{$order->order_num}}</h2>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                <td>{{ number_format($product->price * $order->quantity, 2) }} €</td>
            </tr>
            </tfoot>
        </table>
        @if($order->note)
            <div class="note-section">
                <h4>Nota del Pedido</h4>
                <p>{{ $order->note }}</p>
            </div>
        @endif
    </div>

    <!-- Terms and Conditions -->
    <div class="terms">
        <h4>Términos y Condiciones</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at libero non urna viverra tristique. Sed venenatis, urna non condimentum varius, libero arcu viverra ligula, in varius nisi urna et velit. Fusce auctor, velit in venenatis bibendum, purus ligula tempus turpis, a dictum sapien dolor vel velit. Vivamus non varius libero. Suspendisse potenti.</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Gracias por su compra</p>
        <p>© 2024 {{$company['name']}}. Todos los derechos reservados.</p>
    </div>
</div>
</body>
</html>
