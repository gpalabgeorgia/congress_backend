<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Georgian Worldwide Congress</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<!-- ქუდი დაბინდული ფონის ეფექტით (Blur) -->
    @include('includes.header')

    @yield('content')

    @include('includes.footer')
<!-- ღილაკი ზემოთ (Back to Top) -->
<button class="back-to-top" id="backToTopBtn" aria-label="Наверх">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="19" x2="12" y2="5"></line>
        <polyline points="5 12 12 5 19 12"></polyline>
    </svg>
</button>

<script src="{{ url('js/main.js') }}"></script>
</body>
</html>
