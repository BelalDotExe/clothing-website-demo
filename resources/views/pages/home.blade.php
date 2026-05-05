@extends('layouts.customer')

@section('title', 'Chroma - Wear Your True Colors')
@section('body_class', 'landing-page')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero__inner">
            <div class="hero__content">
                <h1>Wear Your True Colors</h1>
                <p>Discover our vibrant collection of authentic, high-quality clothing that celebrates your unique style.</p>
                <a href="/categories/womens-wear" class="btn btn--primary">Shop Now</a>
            </div>
        </div>
    </section>

    <!-- Featured Section -->
    <section class="featured">
        <div class="container">
            <h2>Featured Collection</h2>
            <p class="section-subtitle">New arrivals and bestsellers</p>
            <!-- Featured items will go here -->
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/landing.js') }}"></script>
@endpush
