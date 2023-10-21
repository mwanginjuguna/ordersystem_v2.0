<?php
@component('mail::message')
    # Order Activity: {{ $data['actionName'] }}

    Dear Writer,

    You have a new activity on one of your active orders #{{$data['orderId']}}.

    The action/activity for the order is: ***{{ $data['actionName'] }}***.

    @component('mail::button', ['url' => route('orders.show', $data['orderId'])])
        View Order
    @endcomponent

    You are expected to check on this immediately and confirm. If you require extra information, clarification, and/or you have questions, kindly respond immediately.

    As usual, top quality work is expected from you. Every resource/paper from you is expected to plagiarism-free and thoroughly checked for grammatical errors. Failure to observing professional academic standard may automatically lead to corrective actions.

    Best regards,<br>
    The Quality Assurance Team.
    {{ config('app.name') }}
@endcomponent
