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
            <h1>Thank You for Your Order! - (Order #{{ $order->id }})</h1>
        </div>
        <h2>Order Received Notification</h2>
        <p>Dear {{ $user }},<br>
            Thank you for placing your order with us.
            To ensure that your order can be assigned to an expert for completion,
            please complete payment as soon as possible.</p>

        <ul style="margin-bottom: 64px;">
            <li class="my-2">
                Order #{{ $order->id }} - {{ $order->topic }}
            </li>
            <li class="my-2">
                Service Type/Task: {{ $service }}
            </li>
            <li class="my-2">
                Academic Level: {{ $level }}
            </li>
            <li class="my-2">
                Subject area / Discipline: {{ $subjectType }}
            </li>
            <li class="my-2">
                Due
                @if(str_ends_with($deadline, 'ago'))
                    <span class="underline md:text-sm text-red-400">
                                {{ $deadline }}</span>
                @else
                    <span class="underline md:text-sm text-lime-800">
                                {{ $deadline }}</span>.
                @endif
            </li>
            @if($order->pages > 0)
                <li class="my-2" >
                    Pages: {{ $order->pages }} / {{ $order->pages * 275 }} words
                </li>
            @endif
            @if($order->slides > 0)
                <li class="my-2">
                    Slides: {{ $order->slides }}
                </li>
            @endif
            @if($discountAmount > 0)
                <li class="my-2">
                    Discount/Coupon: "{{ $discount }}" - {{ $discountAmount }}% Off
                </li>
            @endif
        </ul>
        <div style="width: 80%; margin: auto;">
            To complete payment, please follow this link:
            <a href="{{route('orders.preview', $order->id)}}"
               style="color: #3f21ff; text-decoration: underline;">
                Pay Now
            </a>
            <div class="btn">
                <a href="{{route('orders.preview', $order->id)}}" style="color: white">
                    Pay Now
                </a>
            </div>
        </div>

        <div class="email-footer">
            <a href="/" style="flex-wrap: wrap; place-items: center;)">
                <h3>
                    <img id="logo-image"
                         src="https://www.mediafire.com/view/kcq4lp1hq41nq0h/OrderSystem-logos.jpeg/file"
                         alt="OS">
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

    <div class="email-credits">
        <b>© {{ now()->year }} certified institution. All rights reserved.</b>
    </div>
</main>
</body>
</html>

