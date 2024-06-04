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
            background-color: #f8f9fa;
            color: #343a40;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            flex: 1;
            padding: 20px;
            max-width: 100%;
        }
        .header, .footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h2, .footer p {
            margin: 0;
        }
        .company-client-details {
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .client-details {
            float: left;
            margin-left: 5px;
            width: 60%;
        }
        .company-details {
            float: right;
            width: 60%;
            text-align: right;
            margin-right: 5px;
        }
        .order-details {
            clear: both;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .order-details h2 {
            margin-bottom: 20px;
        }
        .terms {
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .note-section {
            padding: 20px;
            background-color: #fffbeb;
            border: 1px solid #ffeeba;
            border-radius: 5px;
            margin-top: 20px;
        }
        .table thead {
            background-color: #343a40;
            color: #ffffff;
        }
        .table tfoot {
            background-color: #f1f1f1;
        }
        .company-details img {
            margin-bottom: 10px;
        }
        .dates-section {
            margin-bottom: 20px;
        }
        .dates-section p {
            margin: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        <h2>Detalles del Pedido</h2>
    </div>

    <!-- Company and Client Details -->
    <div class="company-client-details">
        <div class="client-details">
            <h2>Datos del Cliente</h2>
            <p><strong>Nombre:</strong> nombre_cliente</p>
            <p><strong>Email:</strong> {{$order->email}}</p>
            <p><strong>Dirección:</strong> direccion_cliente</p>
        </div>
        <div class="company-details">
            <img src="{{ public_path('img/logo.jpg') }}" alt="logo" height="100" width="100">
            <h2>{{$company['name']}}</h2>
            <p>{{$company['direction']}}</p>
            <p>Teléfono: {{$company['contact']}}</p>
            <p>Email: {{$company['email']}}</p>
        </div>
    </div>

    <!-- Order Details -->
    <div class="order-details">
        <h2>Número de pedido: {{$order->order_num}}</h2>
        <div class="dates-section">
            <p><strong>Fecha Emisión:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</p>
            <p><strong>Fecha Vencimiento:</strong> {{ \Carbon\Carbon::parse($order->created_at)->addDays(30)->format('d/m/Y') }}</p>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{ number_format($product->price, 2) }} €</td>
                <td>{{ number_format($product->price * $order->quantity, 2) }} €</td>
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
        <p><strong>1. Introducción</strong></p>
        <p>Estos términos y condiciones establecen las reglas y regulaciones para el uso de los servicios proporcionados por {{$company['name']}}.</p>

        <p><strong>2. Pedidos y Pagos</strong></p>
        <p>Todos los pedidos están sujetos a la disponibilidad de los productos. Los precios y la disponibilidad pueden estar sujetos a cambios sin previo aviso. El pago debe realizarse en su totalidad al momento de la compra.</p>

        <p><strong>3. Envío y Entrega</strong></p>
        <p>Hacemos todo lo posible para entregar los productos dentro de los plazos estimados. Sin embargo, no nos hacemos responsables de los retrasos debidos a circunstancias fuera de nuestro control.</p>

        <p><strong>4. Devoluciones y Reembolsos</strong></p>
        <p>Las devoluciones son aceptadas dentro de los 30 días posteriores a la recepción del pedido, siempre que los productos estén en su estado original. Los reembolsos se procesarán en un plazo de 14 días a partir de la recepción de la devolución.</p>

        <p><strong>5. Garantías y Responsabilidad</strong></p>
        <p>Nuestros productos están garantizados contra defectos de fabricación por un período de 12 meses. No nos hacemos responsables de los daños derivados del uso indebido de los productos.</p>

        <p><strong>6. Protección de Datos</strong></p>
        <p>Nos comprometemos a proteger su privacidad y sus datos personales. Para más información, consulte nuestra Política de Privacidad.</p>

        <p><strong>7. Modificaciones</strong></p>
        <p>Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. Los cambios serán efectivos a partir de su publicación en nuestro sitio web.</p>

        <p><strong>8. Contacto</strong></p>
        <p>Si tiene alguna pregunta o inquietud sobre estos términos y condiciones, puede contactarnos a través del correo electrónico: {{$company['email']}}.</p>

        <p><strong>9. Ley Aplicable</strong></p>
        <p>Estos términos y condiciones se regirán e interpretarán de acuerdo con las leyes del país en el que operamos, sin tener en cuenta sus conflictos de disposiciones legales.</p>

        <p><strong>10. Aceptación de los Términos</strong></p>
        <p>Al realizar un pedido con nosotros, usted acepta estos términos y condiciones en su totalidad.</p>
    </div>
</div>
<!-- Footer -->
<div class="footer">
    <p>Gracias por su compra</p>
    <p>© 2024 {{$company['name']}}. Todos los derechos reservados.</p>
</div>
</body>
</html>
