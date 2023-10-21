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
    <div class="table-div"
         style="margin: 64px auto;
            background-color: #a8ff73;
            padding: 60px;
            width: 60%;
            border-radius: 20px;">
        <h1 style="text-align: center;
                color: #2b00ab;
                font-size: x-large;
                text-decoration: underline; padding-bottom: 20px; padding-top: 20px">
            {{ $title }}
        </h1>
        <p style="margin: 50px auto auto;">Dear {{ $username ?? 'Admin' }},<br>
            {!! $content !!}
        </p>

        <div class="email-footer"
             style="margin: 80px auto auto;width: 80%;
         text-align: center;padding: 48px;
         border-radius: 12px;">

            <a href="/" style="flex-wrap: wrap; place-items: center;)">
                <h3>
                    <img id="logo-image"
                         {{-- {{ $message->embed('public/logo/OrderSystem-logos.jpeg') }} --}}
                         src="https://www.mediafire.com/view/kcq4lp1hq41nq0h/OrderSystem-logos.jpeg/file"
                         alt="OS"
                         style="
                         max-width: 150px;
                         max-height: 150px;
                         "
                    >
                    <span style="flex: auto; display: inline-flex; height: auto;">{{ env('APP_NAME') }}
                    </span>
                </h3>
            </a>

            <p style="font-style: italic;"
            >Our Team of Experts is ready to provide any required assistance to Ace your Homework.
            </p>

            <a href="{{ env('HOME_URL') }}">Our Website - <{{ env('APP_NAME') }}></a>
            <p>{{ env('SYSTEM_EMAIL') }}</p>
            <p>+{{ env('SYSTEM_PHONE_NUMBER') }}</p>
        </div>
    </div>

    <div class="email-credits">
        <b>{{ now()->year }} certified institution. All rights reserved.</b>
    </div>
</main>
</body>
</html>

