@component('mail::message')
    # Order Activity: {{ $actionTitle }}

    Dear User,
    This is to notify you that We have detected a recent activity on your current order #{{$data['orderId']}}.

    The action/activity for the order is: ***{{ $data['orderAction'] }}***.

    @component('mail::button', ['url' => route('orders.show', $data['orderId'])])
        View Order
    @endcomponent

   An expert has been assigned to look into the activity immediately. If any action is required on your end, an update will be communicated soon.

    Thanks,<br>
    The Quality Assurance Team.
@endcomponent
