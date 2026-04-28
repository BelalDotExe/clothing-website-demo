<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aura - Shopping Cart</title>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body class="cart-page">
    <header class="cart-header">
        <div class="cart-shell cart-header__inner">
            <a class="cart-brand" href="/">
                <span class="cart-brand__mark">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <path fill="currentColor" d="M6 7a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v1h-2V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v1H6V7zm0 3h12l1.2 10.2A2 2 0 0 1 17.2 22H6.8a2 2 0 0 1-1.99-1.8L6 10zm4 2a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4z"/>
                    </svg>
                </span>
                <span class="cart-brand__name">Aura</span>
            </a>

            <nav class="cart-nav">
                <a href="/categories/womens-wear">Men's Wear</a>
                <a href="/categories/womens-wear">Women's Wear</a>
                <a href="/categories/womens-wear">Shoes</a>
                <a href="/categories/womens-wear">Accessories</a>
            </nav>

            <div class="cart-head-actions">
                <button type="button" class="icon-btn">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                </button>
                <a class="icon-btn" href="/admin/login">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </a>
                <a class="icon-btn cart-bag" href="/cart">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                        <path d="M3 6h18"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    <span class="cart-bag__count" id="cartCount">0</span>
                </a>
            </div>
        </div>
    </header>

    <main class="cart-shell cart-main">
        <div class="cart-top">
            <h1>Shopping Cart</h1>
            <span id="itemText">0 items</span>
        </div>

        <div class="cart-grid">
            <section class="cart-list" id="cartList"></section>

            <aside class="summary" id="summaryBox">
                <h2>Order Summary</h2>

                <div class="sum-rows">
                    <div class="sum-row">
                        <span id="subText">Subtotal (0 items)</span>
                        <span id="subVal">$0.00</span>
                    </div>
                    <div class="sum-row">
                        <span>Shipping</span>
                        <span class="free">Free</span>
                    </div>
                </div>

                <div class="sum-row sum-total">
                    <span>Total</span>
                    <span id="totalVal">$0.00</span>
                </div>

                <button type="button" class="checkout-btn">Proceed to Checkout</button>

                <p class="safe-note">Secure checkout provided by Stripe</p>
            </aside>
        </div>
    </main>

    <script src="{{ asset('js/cart.js') }}"></script>
</body>
</html>
