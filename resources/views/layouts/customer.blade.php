<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Chroma - Wear Your True Colors')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Smooch+Sans:wght@100..900&display=swap" rel="stylesheet">
    @stack('styles')
</head>

<body class="@yield('body_class', '')">
    <div class="site-wrap">
        @hasSection('header')
            @yield('header')
        @else
            @include('components.customer.header')
        @endif

        <div class="main-content">
            @yield('content')
        </div>

        @include('components.customer.footer')
    </div>

    @stack('scripts')
</body>

</html>
