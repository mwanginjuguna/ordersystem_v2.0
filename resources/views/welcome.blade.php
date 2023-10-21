<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            main {
                background-color: #e5e7eb;
                color: #080808;
                padding: 24px;
                border-radius: 12px;
            }
            h1 {
                text-align: center;
                color: #2b00ab;
                font-size: x-large;
                text-decoration: underline;
            }
            table {
                border: 1px solid #14062f;
                border-radius: 8px;
                color: #14062f;
                padding: 12px;
                margin: auto;
            }
            th {
                text-align: end;
            }
            th, td {
                padding: 8px;
                margin: auto;
                color: #000272;
            }
            .table-div {
                margin: 64px auto;
                background-color: #a8ff73;
                padding: 60px;
                width: 60%;
                border-radius: 20px;
            }
            h3 {
                color: #100936;
                text-decoration: underline;
            }

            .email-footer {
                background-color: white;
                margin: 80px auto auto;
                width: 80%;
                text-align: center;
                padding: 48px;
                border-radius: 12px;
                box-shadow: 2px 2px #5d77a9;

            }
            .email-footer2 {

                margin: 80px auto auto;
                width: 80%;
                text-align: center;
                padding: 48px;
                border-radius: 12px;


            }
            .email-credits {
                width: 50%;
                padding-left: 12px;
                text-decoration: underline;
                margin: 32px auto;
            }
            .email-content {
                padding: 32px 48px;
                background-color: white;
                border-radius: 12px;
                box-shadow: 2px 2px rgba(9,0,255,0.54);
            }
            #logo-image {
                border-radius: 130px;
            }

            .btn {
                margin: 48px 32px;
                background-color: royalblue;
                padding: 16px 32px;
                border-radius: 8px;
                font-weight: bold;
                font-size: large;
                text-decoration: underline;
                width: fit-content;
            }
        </style>
    </head>
    <body class="antialiased">
    <main>

        <div class="email-content"  style="width: 80%; margin: auto">
            <div class="top-header">
                <h1 style="text-align: center;
                color: #2b00ab;
                font-size: x-large;
                text-decoration: underline;">
                    This is the Email Topic.
                </h1>
            </div>
            <h2>The email content goes here.</h2>
            <p>Dear John Doe,<br>
                Lorem ipsum dolor sit amet consectetur adipiscing elit justo, nisl risus vehicula ornare imperdiet porta cum, pulvinar dui sed aenean diam erat a. Taciti tristique congue nullam euismod semper erat, dictum luctus volutpat aenean aliquet himenaeos, tortor venenatis primis porttitor pellentesque. Auctor id quam ut sagittis suscipit vitae hac nam, fermentum tortor ad netus curae non porttitor, scelerisque tempor blandit iaculis felis tellus lacinia.</p>

            <ul style="margin-bottom: 64px;">
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                <li>Fringilla commodo taciti nostra habitant ante, aliquam consequat egestas nullam.</li>
                <li>Hac justo a vulputate, quis penatibus ut sem, nostra non.</li>
                <li>Et rutrum potenti gravida lobortis, leo nunc nisi.</li>
                <li>Mauris magnis imperdiet vulputate non neque, habitant auctor congue.</li>
                <li>Suspendisse duis tortor curabitur vel, pharetra ut sociis.</li>
            </ul>
            <div style="width: 80%; margin: auto;">
                <div class="btn">
                    <a href="/" style="color: white">
                        View Resource
                    </a>
                </div>
            </div>

            <div class="email-footer2">
                <a href="/" style="flex-wrap: wrap; place-items: center;)">
                    <h3>
                        <img id="logo-image" src="https://randomuser.me/api/portraits/men/53.jpg" alt="logo-image">
                        <span style="flex: auto; display: inline-flex; height: auto;">
                        Our Logo Company
                    </span>
                    </h3>
                </a>

                <p style="font-style: italic;">Punchline tagliner</p>
                <a href="www.google.com">Our Website Link</a>
                <p>email@ourwebsite.com</p>
                <p>+125496789</p>
            </div>
        </div>


        <div class="table-div">
            <h3 style="text-align: center">PAYMENTS DETAILS</h3>
            <table class="table">
                <tbody>
                <tr>
                    <th>Amount</th>
                    <td>$34.99</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>12/25/2005</td>
                </tr>
                <tr>
                    <th>Transaction Id</th>
                    <td>5674895615fd6gth6</td>
                </tr>
                <tr>
                    <th>Order Id</th>
                    <td>34599</td>
                </tr>
                </tbody>
            </table>

            <p style="margin: 50px auto auto;">
                Lorem ipsum dolor sit amet consectetur adipiscing elit justo, nisl risus vehicula ornare imperdiet porta cum, pulvinar dui sed aenean diam erat a. Taciti tristique congue nullam euismod semper erat, dictum luctus volutpat aenean aliquet himenaeos, tortor venenatis primis porttitor pellentesque. Auctor id quam ut sagittis suscipit vitae hac nam, fermentum tortor ad netus curae non porttitor, scelerisque tempor blandit iaculis felis tellus lacinia.
            </p>
        </div>

        <div class="email-footer">
            <a href="/" style="flex-wrap: wrap; place-items: center;)">
                <h3>
                    <img id="logo-image"
                         src="{{ \Illuminate\Support\Facades\Vite::asset('public/logo/OrderSystem-logos.jpeg') }}"
                         alt="logo-image"
                         style="
                         max-width: 150px;
                         max-height: 150px;
                         "
                    >
                    <span style="flex: auto; display: inline-flex; height: auto;">{{ env('APP_NAME') }}
                    </span>
                </h3>
            </a>

            <p style="font-style: italic;">Punchline tagliner</p>
            <a href="www.google.com">Our Website Link</a>
            <p>email@ourwebsite.com</p>
            <p>+125496789</p>
        </div>
        <div class="email-credits">
            <b>2023 certified institution. All rights reserved.</b>
        </div>
    </main>
    </body>
</html>
