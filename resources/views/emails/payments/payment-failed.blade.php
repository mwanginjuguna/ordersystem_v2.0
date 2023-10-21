<section>
    <div class="table-div"
         style="margin: 64px auto;
            background-color: #a8ff73;
            padding: 60px;
            width: 60%;
            border-radius: 20px;">
        <p style="margin: 50px auto auto;">Dear {{ $username }},<br>
            Your Payment for Order #{{ $orderId }} has Failed.
            There was an error in processing your payment. Please try again.</p>
        <div style="width: 80%; margin: auto;">
            To complete payment, please follow this link:
            <a href="{{route('orders.preview', $order->id)}}"
               style="color: #3f21ff; text-decoration: underline;">
                Pay Now
            </a>.
            <div class="btn">
                <a href="/" style="color: white">
                    Pay Now
                </a>
            </div>
        </div>
    </div>
</section>

<div class="email-footer"
     style="margin: 80px auto auto;width: 80%;
         text-align: center;padding: 48px;
         border-radius: 12px;">

    <a href="/" style="flex-wrap: wrap; place-items: center;)">
        <h3>
            <img id="logo-image"
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

    <p style="font-style: italic;">Ready to Serve Your Requests</p>
    <a href="www.google.com">Our Website Link</a>
    <p>email@ourwebsite.com</p>
    <p>+125496789</p>
</div>
