@extends('layouts.customer')

@section('title', 'Shopping Cart - Chroma')
@section('body_class', 'cart-page')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endpush

@section('content')
    <section class="cart-shell cart-main">
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
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/cart.js') }}"></script>
@endpush
