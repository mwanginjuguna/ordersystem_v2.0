<x-mail::message>
# Introduction
Dear {{ $username }},
Your order #{{ $order->id }} - "{{ $order->title }}" has been submitted.
    The order has been reviewed by our QA team and submitted for your review.
    Kindly review the order and let us know if it meets your requirements.
    We will be happy to make adjustments and revisions until you are satisfied with the final product.

<x-mail::button :url="{{ route('orders.show', $order->id) }}">
View Order
</x-mail::button>

Best regards,<br>
Quality Assurance Team - {{ config('app.name') }}

    <div style="text-align: center;">
        ![Image Alt Text]({{ Vite::asset(public_path('/logo/orderSystem-logos_black.png')) }})
    </div>

    <div style="text-align: center;">
        # {{ config('app.name') }}
    </div>
</x-mail::message>
