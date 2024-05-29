<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .content {
            padding: 20px;
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
<div class="content">
    <h2 class="text-2xl font-semibold mb-4">Pedido Realizado</h2>
    <p>El cliente {{$email}} acaba de realizar el siguiente pedido</p>
    <p>----------</p>
    <p>Producto: {{$name}}</p>
    <p>Cantidad: {{$quantity}}</p>
    <p>Total: {{$total}} €</p>
    <p class="mt-4">Nota:  {{$note}}</p>
    <p></p>
</div>
</body>
</html>





