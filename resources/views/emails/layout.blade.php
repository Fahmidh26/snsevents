<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'SNS Events Notification' }}</title>
    <style>
        body {
            font-family: 'Poppins', Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table {
            border-collapse: collapse !important;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header {
            background-color: #0f0f0f;
            padding: 40px 20px;
            text-align: center;
            border-bottom: 4px solid #c9a227;
        }
        .header h1 {
            color: #c9a227;
            font-family: 'Playfair Display', serif;
            margin: 0;
            font-size: 28px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .content {
            padding: 40px 30px;
            color: #333333;
            line-height: 1.8;
        }
        .content h2 {
            color: #0f0f0f;
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            margin-top: 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
            padding-bottom: 10px;
        }
        .details-table {
            width: 100%;
            margin-bottom: 30px;
        }
        .details-table td {
            padding: 12px 0;
            border-bottom: 1px solid #f9f9f9;
        }
        .details-table .label {
            font-weight: 600;
            color: #0f0f0f;
            width: 150px;
            vertical-align: top;
        }
        .details-table .value {
            color: #666666;
        }
        .button-container {
            text-align: center;
            margin-top: 30px;
        }
        .button {
            background: linear-gradient(135deg, #c9a227 0%, #d4af37 100%);
            color: #ffffff !important;
            padding: 15px 35px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(201, 162, 39, 0.3);
        }
        .footer {
            background-color: #f8f8f8;
            padding: 30px 20px;
            text-align: center;
            color: #999999;
            font-size: 12px;
            border-top: 1px solid #eeeeee;
        }
        .footer p {
            margin: 5px 0;
        }
        .highlight {
            color: #c9a227;
            font-weight: 600;
        }
        @media screen and (max-width: 600px) {
            .content {
                padding: 30px 20px;
            }
            .details-table .label {
                width: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SNS Events</h1>
        </div>
        <div class="content">
            @yield('content')
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} SNS Events. All rights reserved.</p>
            <p>Premium Event Planning & Decoration Services</p>
        </div>
    </div>
</body>
</html>
