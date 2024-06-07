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
            font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
        }
        .main {
            width: 100%;
            max-width: 600px;
            background: #fff;
            border: 1px solid #e9e9e9;
            border-radius: 8px;
            overflow: hidden;
        }

        .content-wrap {
            padding: 20px;
        }

        .header,
        .footer {
            text-align: center;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 0;
            width: 400px;
        }

        .header img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            height: 80px;
            width: 80px;
        }

        .content-block {
            padding: 20px 0;
        }

        .content-block div {
            color: #333333;
            font-size: 16px;
            line-height: 1.5;
        }

        button {
            margin-top: 20px;
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
                                    <img src="{{ $message->embed(public_path('img/logo.jpg')) }}" alt="logo" height="80" width="80">
                                </td>
                            </tr>
                            <tr>
                                <td class="content-block">
                                    {!! $htmlContent !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="footer" style="color: white">
                                    <p style="color: white">Este email ha sido generado automáticamente.<br>Contacto: <a style="color: white" href="mailto:jacain99laravel@gmail.com">jacain99laravel@gmail.com</a></p>
                                    <p style="color: white">Síguenos en nuestras redes sociales:</p>
                                    <p style="color: white">
                                        <a style="color: white" href="#">Facebook</a> | <a style="color: white" href="#">Twitter</a> | <a style="color: white" href="#">Instagram</a>
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
