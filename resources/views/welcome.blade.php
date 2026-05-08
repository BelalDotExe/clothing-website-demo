<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H&B Clothing - Wear Your True Colors</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Smooch+Sans:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

</head>

<body>
    <div class="site-wrap">
        <header class="lp-header">
            <div class="container lp-header__inner">
                <a href="/" class="lp-brand" aria-label="Home">
                    <span class="lp-brand__mark">
                        {{-- logo --}}
                        <svg viewBox="0 0 24 24" width="20" height="20" role="img">
                            <path fill="currentColor"
                                d="M6 7a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v1h-2V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v1H6V7zm0 3h12l1.2 10.2A2 2 0 0 1 17.2 22H6.8a2 2 0 0 1-1.99-1.8L6 10zm4 2a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4z" />
                        </svg>
                    </span>
                    <span class="lp-brand__name">H&B CLOTHING</span>
                </a>

                <button class="lp-menu-toggle" id="hbMenuToggle" type="button" aria-expanded="false"
                    aria-controls="hbNav">
                    Menu
                </button>

                <nav class="lp-nav" id="hbNav" aria-label="Primary navigation">
                    <a class="lp-nav__link lp-nav__link--active" href="/" aria-current="page">Home</a>
                    <a class="lp-nav__link" href="/categories/womens-wear">Categories</a>
                    <a class="lp-nav__link lp-nav__link--sale" href="/categories/womens-wear#sale">Sale</a>
                </nav>

                <div class="lp-actions" aria-label="Quick actions">
                    <a class="lp-icon-btn" href="/admin/login" aria-label="Admin">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" role="img" aria-hidden="true">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </a>
                    <a class="lp-icon-btn lp-cart" href="/cart" aria-label="Cart">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" role="img" aria-hidden="true">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                            <path d="M3 6h18"/>
                            <path d="M16 10a4 4 0 0 1-8 0"/>
                        </svg>
                        <span class="lp-cart__dot" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </header>

        <section class="banners container" aria-label="Store promotions">
            <div class="banner" id="promo-banner" aria-live="polite">
                <div class="banner-text active" aria-hidden="false">
                    <span class="banner-icon">NEW</span>
                    New Arrivals: Fresh Styles Just In
                </div>
                <div class="banner-text" aria-hidden="true">
                    <span class="banner-icon">SALE</span>
                    50% Off on Every Product
                </div>
                <div class="banner-text" aria-hidden="true">
                    <span class="banner-icon">PERKS</span>
                    Exclusive: Members Get Free Returns
                </div>
            </div>
        </section>

        <main>
            <section class="hero container">
                <div class="hero-copy" >
                    <span class="eyebrow">SPRING COLLECTION 2025</span>
                    <h1 style=" font-family: 'Smooch Sans', sans-serif; font-optical-sizing: auto;margin-top: 20px;" >Wear Your True Colors</h1>
                    <p style="margin-top: 40px;">
                        Discover our latest collection of vibrant modern apparel
                        designed to make a statement. Bold silhouettes meet bold palettes.
                    </p>
                    <a class="cta-btn" href="/categories/womens-wear">Shop the Collection</a>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('images/hero.jpg') }}" alt="Spring Collection 2025" loading="eager">
                </div>
            </section>

            <section class="container section">
                <h2 class="section-title" style=" font-family: 'Smooch Sans', sans-serif; font-optical-sizing: auto; font-size: 50px;">Shop by Category</h2>
                <div class="category-grid">
                    <article class="category-card">
                        <img src="{{ asset('images/womenswear.jpg') }}" alt="Womens Wear" loading="lazy">
                        <div class="overlay">
                            <h3>Womens Wear</h3>
                            <a href="/categories/womens-wear">Explore</a>
                        </div>
                    </article>
                    <article class="category-card">
                        <img src="{{ asset('images/menswear.jpg') }}" alt="Mens Wear" loading="lazy">
                        <div class="overlay">
                            <h3>Mens Wear</h3>
                            <a href="/categories/womens-wear#mens-wear">Explore</a>
                        </div>
                    </article>
                    <article class="category-card">
                        <img src="{{ asset('images/accessories.jpg') }}" alt="Accessories" loading="lazy">
                        <div class="overlay">
                            <h3>Accessories</h3>
                            <a href="/categories/womens-wear#accessories">Explore</a>
                        </div>
                    </article>
                </div>
            </section>

            <section class="container section trend-section">
                <h2 class="section-title" style=" font-family: 'Smooch Sans', sans-serif; font-optical-sizing: auto; font-size: 50px;">Trending Now</h2>
                <div class="product-grid">
                    @php
                        $fallbackImage = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 800'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop offset='0' stop-color='%23d8d8c7'/%3E%3Cstop offset='1' stop-color='%23f4f4e8'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='600' height='800' fill='url(%23g)'/%3E%3Cpath d='M162 560l92-118l80 104l40-54l104 128H122z' fill='%23c3c3b1'/%3E%3Ccircle cx='252' cy='296' r='54' fill='%23c9c9b8'/%3E%3C/svg%3E";
                    @endphp
                    @forelse (($trendingProducts ?? collect()) as $product)
                        @php
                            $image = (string) ($product->image ?? '');
                            if ($image === '') {
                                $imageUrl = $fallbackImage;
                            } elseif (str_starts_with($image, 'http://') || str_starts_with($image, 'https://') || str_starts_with($image, 'data:') || str_starts_with($image, '/storage/')) {
                                $imageUrl = $image;
                            } else {
                                $imageUrl = asset('storage/'.$image);
                            }
                        @endphp
                        <article class="product-card">
                            <div class="product-media">
                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" loading="lazy" style="width:100%; height:100%; object-fit:cover; border-radius:8px;">
                                @if ((int) ($product->stock ?? 0) > 0 && (int) ($product->stock ?? 0) <= 5)
                                    <div class="tag low">LOW STOCK</div>
                                @endif
                            </div>
                            <h3>{{ $product->name }}</h3>
                            <p class="price">${{ number_format((float) $product->price, 2) }}</p>
                            <a href="/categories/womens-wear" class="add-cart-btn" style="display:inline-flex;align-items:center;justify-content:center;text-decoration:none;">View Product</a>
                        </article>
                    @empty
                        <article class="product-card">
                            <div class="placeholder-block product-media"><span>No products yet</span></div>
                            <h3>New arrivals coming soon</h3>
                            <p class="price">Add products from Admin to show them here.</p>
                            <a href="/admin/products" class="add-cart-btn" style="display:inline-flex;align-items:center;justify-content:center;text-decoration:none;">Manage Products</a>
                        </article>
                    @endforelse
                </div>
            </section>
        </main>
    </div>

    <script src="{{ asset('js/landing.js') }}"></script>

</body>

</html>
