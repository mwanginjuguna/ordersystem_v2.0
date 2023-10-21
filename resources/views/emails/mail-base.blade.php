<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <!-- The CSS stylesheet which will be inlined. -->

    @vite(['resources/css/mail.css', 'resources/js/app.js'])

    @if($subject = $attributes->get('subject'))
        <title>{{ $subject }}</title>
    @endif
</head>
<body>
<div class="w-full h-full px-8 py-12">
    {{ $slot }}
</div>
</body>
</html>
