<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$subjectContent}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            /*font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;*/
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
            text-align: center;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 0;
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
            <table class="main">
                <tr>
                    <td class="content-wrap">
                        <table>
                            <tr>
                                <td class="header">
                                    <img src="{{ public_path('img/logo.jpg') }}" alt="logo" height="80" width="80">
                                </td>
                            </tr>
                            <tr>
                                <td class="content-block">
                                    {!! $htmlContent !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="footer">
                                    <p>Este email ha sido generado automáticamente.<br>Contacto: <a href="mailto:jacain99laravel@gmail.com">jacain99laravel@gmail.com</a></p>
                                    <p>Síguenos en nuestras redes sociales:</p>
                                    <p>
                                        <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">Instagram</a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>












{{--</html>--}}



{{--    <!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>{{$subjectContent}}</title>--}}
{{--    <style>--}}
{{--        body {--}}
{{--            -webkit-font-smoothing: antialiased;--}}
{{--            -webkit-text-size-adjust: none;--}}
{{--            width: 100% !important;--}}
{{--            height: 100%;--}}
{{--            line-height: 1.6;--}}
{{--            background-color: #f6f6f6;--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--            font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;--}}
{{--        }--}}

{{--        .custom-dialog-content {--}}
{{--            background-color: #f4f4f4;--}}
{{--            padding: 20px;--}}
{{--            border-radius: 8px;--}}
{{--        }--}}

{{--        img {--}}
{{--            max-width: 100%;--}}
{{--        }--}}

{{--        .body-wrap {--}}
{{--            width: 100%;--}}
{{--            background-color: #f4f4f4;--}}
{{--        }--}}

{{--        .container {--}}
{{--            display: flex;--}}
{{--            justify-content: center;--}}
{{--        }--}}

{{--        .main {--}}
{{--            width: 100%;--}}
{{--            max-width: 600px;--}}
{{--            background-color: #ffffff;--}}
{{--            border: 1px solid #dddddd;--}}
{{--            border-radius: 8px;--}}
{{--            overflow: hidden;--}}
{{--        }--}}

{{--        .content-wrap {--}}
{{--            padding: 20px;--}}
{{--        }--}}

{{--        .logo-img {--}}
{{--            max-width: 100%;--}}
{{--            height: auto;--}}
{{--        }--}}

{{--        .header {--}}
{{--            background-color: #007bff;--}}
{{--            color: #ffffff;--}}
{{--            text-align: center;--}}
{{--            padding: 10px 0;--}}
{{--            width: 100%;--}}
{{--        }--}}

{{--        .header img {--}}
{{--            display: block;--}}
{{--            margin-left: auto;--}}
{{--            margin-right: auto;--}}
{{--            height: 80px;--}}
{{--            width: 80px;--}}
{{--        }--}}

{{--        .content-block {--}}
{{--            padding: 20px 0;--}}
{{--        }--}}

{{--        .content-block div {--}}
{{--            color: #333333;--}}
{{--            font-size: 16px;--}}
{{--            line-height: 1.5;--}}
{{--        }--}}

{{--        button {--}}
{{--            margin-top: 20px;--}}
{{--        }--}}

{{--        /* Estilos específicos del botón en mat-dialog-actions */--}}
{{--        .mat-dialog-actions {--}}
{{--            display: flex;--}}
{{--            justify-content: flex-end;--}}
{{--            padding: 10px 0 0;--}}
{{--            border-top: 1px solid #dddddd;--}}
{{--        }--}}

{{--        .mat-dialog-actions button {--}}
{{--            margin-left: 10px;--}}
{{--        }--}}

{{--        /* Estilos para centrar el modal */--}}
{{--        .modal-container {--}}
{{--            width: 80vw;--}}
{{--            height: 80vh;--}}
{{--            max-width: 90vw;--}}
{{--            max-height: 90vh;--}}
{{--        }--}}

{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="todo">--}}
{{--    <div class="custom-dialog-content">--}}
{{--        <table class="body-wrap">--}}
{{--            <tr>--}}
{{--                <td class="container">--}}
{{--                    <table class="main">--}}
{{--                        <tr>--}}
{{--                            <td class="content-wrap">--}}
{{--                                <table>--}}
{{--                                    <tr>--}}
{{--                                        <td class="header">--}}
{{--                                            <img src="{{ public_path('img/logo.jpg') }}" alt="logo" height="80" width="80" class="logo-img">--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td class="content-block">--}}
{{--                                            <div>{!! $htmlContent !!}</div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                </table>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="footer">--}}
{{--                                <p>Este email ha sido generado automáticamente.<br>Contacto: <a href="mailto:jacain99laravel@gmail.com">jacain99laravel@gmail.com</a></p>--}}
{{--                                <p>Síguenos en nuestras redes sociales:</p>--}}
{{--                                <p>--}}
{{--                                    <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">Instagram</a>--}}
{{--                                </p>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}

