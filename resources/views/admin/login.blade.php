<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - H&B Clothing</title>
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
</head>
<body class="admin-login-page">
    <main class="admin-login-layout">
        <section class="admin-visual" aria-label="Brand showcase">
            <div class="admin-visual__image" aria-hidden="true">
                <img src="" alt="">
            </div>
            <div class="admin-visual__overlay">
                <img src="{{asset('images/admin-login.png') }}" alt="">
            </div>
            <div class="admin-visual__content">
                <div class="admin-brand">
                    

            </div>
        </section>

        <section class="admin-form-side" aria-label="Admin login form">
            <div class="admin-form-card">
                <header class="admin-form-card__header">
                    <h1>Admin Login</h1>
                    <p>Enter your credentials to access the dashboard.</p>
                </header>

                @if ($errors->has('login'))
                    <p class="admin-error-banner">{{ $errors->first('login') }}</p>
                @endif

                <!-- ================= form begins ============================= -->
                <form class="admin-form" action="{{ route('admin.login.post') }}" method="post" novalidate>
                    @csrf
                    <div class="admin-field">
                        <label for="username">Username</label>
                        <div class="admin-input-wrap">
                            <span class="admin-input-icon" >
                                <svg viewBox="0 0 24 24" width="18" height="18" role="img" >
                                    <path fill="currentColor" d="M12 12a4 4 0 1 0-4-4a4 4 0 0 0 4 4zm0 2c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5z"/>
                                </svg>
                            </span>
                            <input id="username" name="username" type="text" autocomplete="username" placeholder="Enter username" value="{{ old('username') }}">
                        </div>
                    </div>

                    <div class="admin-field">
                        <div class="admin-field__head">
                            <label for="password">Password</label>
                        </div>
                        <div class="admin-input-wrap">
                            <span class="admin-input-icon" >
                                <svg viewBox="0 0 24 24" width="18" height="18" role="img" aria-hidden="true">
                                    <path fill="currentColor" d="M17 8h-1V6a4 4 0 0 0-8 0v2H7a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-9a2 2 0 0 0-2-2zm-7-2a2 2 0 0 1 4 0v2h-4V6z"/>
                                </svg>
                            </span>
                            <input id="password" name="password" type="password" autocomplete="current-password" placeholder="Enter password">
                            <button class="admin-toggle-pass" type="button" id="togglePassword" aria-label="Show password">
                                <svg viewBox="0 0 24 24" width="18" height="18" role="img" aria-hidden="true">
                                    <path fill="currentColor" d="M12 5c-7 0-10 7-10 7s3 7 10 7s10-7 10-7s-3-7-10-7zm0 12a5 5 0 1 1 0-10a5 5 0 0 1 0 10zm0-8a3 3 0 1 0 3 3a3 3 0 0 0-3-3z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button class="admin-submit" type="submit">
                        Log In to Dashboard
                        <span>
                            <svg viewBox="0 0 24 24" width="18" height="18" role="img">
                                <path fill="currentColor" d="M13 5l7 7l-7 7l-1.4-1.4l4.6-4.6H4v-2h12.2l-4.6-4.6z"/>
                            </svg>
                        </span>
                    </button>
                </form>

                <!--================== form ends here =============== -->

                <footer class="admin-footer-note">
                    &copy; 2026 H&B Clothing Store. All rights reserved.
                </footer>
            </div>
        </section>
    </main>

    <script src="{{ asset('js/admin-login.js') }}"></script>
</body>
</html>
