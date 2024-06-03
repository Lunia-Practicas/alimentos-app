<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Tus Alimentos - Nuevo Pedido Realizado</title>
    <style>
        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.6;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        img {
            max-width: 100%;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            clear: both;
            display: block;
        }
        .content {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            display: block;
        }
        .main {
            background: #fff;
            border: 1px solid #e9e9e9;
            border-radius: 3px;
            padding: 20px;
        }
        .header,
        .footer {
            width: 100%;
            text-align: center;
        }
        .footer {
            color: #999;
            padding: 20px;
        }
        .footer a {
            color: #999;
        }
        .footer p,
        .footer a {
            font-size: 12px;
        }
        h1, h2, h3, h4 {
            color: #000;
            line-height: 1.2;
            margin: 40px 0 0;
        }
        h1 {
            font-size: 32px;
            font-weight: 500;
        }
        h2 {
            font-size: 24px;
        }
        h3 {
            font-size: 18px;
        }
        h4 {
            font-size: 14px;
            font-weight: 600;
        }
        p, ul, ol {
            margin-bottom: 10px;
            font-weight: normal;
        }
        p li, ul li, ol li {
            margin-left: 5px;
            list-style-position: inside;
        }
        a {
            color: #348eda;
            text-decoration: underline;
        }
        .btn-primary {
            text-decoration: none;
            color: #FFF;
            background-color: #348eda;
            border: solid #348eda;
            border-width: 10px 20px;
            line-height: 2;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
            text-transform: capitalize;
        }
        .clear {
            clear: both;
        }
        @media only screen and (max-width: 640px) {
            h1, h2, h3, h4 {
                font-weight: 600 !important;
                margin: 20px 0 5px !important;
            }
            h1 {
                font-size: 22px !important;
            }
            h2 {
                font-size: 18px !important;
            }
            h3 {
                font-size: 16px !important;
            }
            .container {
                width: 100% !important;
            }
            .content, .content-wrap {
                padding: 10px !important;
            }
            .invoice {
                width: 100% !important;
            }
        }
    </style>
</head>
<body>
<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container">
            <div class="content">
                <table class="main">
                    <tr>
                        <td class="content-wrap">
                            <table>
                                <tr>
                                    <td class="header">
                                        <img src="{{ $message->embed(public_path('img/logo.jpg')) }}" alt="logo" height="80" width="80">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <h1>Nuevo Pedido Realizado</h1>
                                        <p>Hola,</p>
                                        <p>Se ha realizado un nuevo pedido en tu tienda. Aquí están los detalles del pedido:</p>
                                        <p><strong>Cliente:</strong> {{$email}}</p>
                                        <p><strong>Producto:</strong> {{$name}}</p>
                                        <p><strong>Cantidad:</strong> {{$quantity}}</p>
                                        <p><strong>Total:</strong> {{$total}} €</p>
                                        @if(!empty($note))
                                            <p><strong>Nota del Cliente:</strong> {{$note}}</p>
                                        @endif
                                        <p>Por favor, asegúrate de procesar este pedido lo antes posible.</p>
                                        <p>Saludos,<br>El Sistema de Pedidos de Tus Alimentos</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="footer">
                                        <p>Este email ha sido generado automáticamente.<br>Para cualquier consulta, por favor contacta al administrador del sistema.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td></td>
    </tr>
</table>
</body>
</html>
