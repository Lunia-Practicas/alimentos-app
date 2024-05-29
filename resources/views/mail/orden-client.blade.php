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
    <p>Hola {{$email}}! Acabas de realizar el siguiente pedido</p>
    <p>Producto: {{$name}}</p>
    <p>Cantidad: {{$quantity}}</p>
    <p>Total: {{$total}} €</p>
    <p>Nota: {{$note}}</p>
    <p style="color: blue" class="mt-4">Un saludo,<br>Tus Alimentos</p>
</div>
</body>
</html>


{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Solicitud de Pedido</title>--}}
{{--    <style>--}}
{{--        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body class="bg-gray-100 p-4">--}}
{{--<div class="max-w-md mx-auto bg-white p-8 rounded shadow-md">--}}
{{--    <h2 class="text-2xl font-semibold mb-4">Pedido Realizado</h2>--}}
{{--    <p>Hola {{$email}}! Acabas de realizar el siguiente pedido</p>--}}
{{--    <p>Producto: {{$name}}</p>--}}
{{--    <p>Cantidad: {{$quantity}}</p>--}}
{{--    <p>Total: {{$total}} €</p>--}}
{{--    <p>Nota: {{$note}}</p>--}}
{{--    <p class="mt-4">Un saludo,<br>Tus Alimentos</p>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
