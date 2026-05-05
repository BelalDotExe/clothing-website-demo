<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - Aura')</title>
    @stack('styles')
</head>

<body class="@yield('body_class', 'dashboard-page')">
    <div class="dashboard-wrapper">
        @include('components.admin.sidebar')

        <main class="main-content">
            @include('components.admin.topbar')
            
            <div class="main-content__inner">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>

</html>
