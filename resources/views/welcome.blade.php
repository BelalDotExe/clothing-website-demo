<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chroma - Wear Your True Colors</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
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
                    <span class="lp-brand__name">CHROMA</span>
                </a>

                <button class="lp-menu-toggle" id="auraMenuToggle" type="button" aria-expanded="false"
                    aria-controls="auraNav">
                    Menu
                </button>

                <nav class="lp-nav" id="auraNav" aria-label="Primary navigation">
                    <a class="lp-nav__link lp-nav__link--active" href="/" aria-current="page">Home</a>
                    <a class="lp-nav__link" href="/categories/womens-wear">Categories</a>
                    <a class="lp-nav__link" href="#">New Arrivals</a>
                </nav>

                <div class="lp-actions" aria-label="Quick actions">

                    <button class="lp-icon-btn" type="button" aria-label="Account" >
                       <a href="/admin/login"> <i style="font-size:20px;" class="fa-regular fa-user" ></i></a>
                    </button>
                    <button class="lp-icon-btn lp-cart" type="button" aria-label="Cart">
                        <i style="font-size:20px;" class="fa-solid fa-cart-shopping"></i>
                    </button>
                </div>
            </div>
        </header>

        <main>
            <section class="hero container">
                <div class="hero-copy" >
                    <span class="eyebrow">SPRING COLLECTION 2025</span>
                    <h1 style=" font-family: 'Smooch Sans', sans-serif; font-optical-sizing: auto;margin-top: 20px;" >Wear Your True Colors</h1>
                    <p style="margin-top: 40px;">
                        Discover our latest collection of vibrant modern apparel
                        designed to make a statement. Bold silhouettes meet bold palettes.
                    </p>
                    <a class="cta-btn" href="#">Shop the Collection</a>
                </div>
                <div class="hero-image placeholder-block">
                    <span>Hero image placeholder</span>
                </div>
            </section>

            <section class="container section">
                <h2 class="section-title" style=" font-family: 'Smooch Sans', sans-serif; font-optical-sizing: auto; font-size: 50px;">Shop by Category</h2>
                <div class="category-grid">
                    <article class="category-card">
                        <div class="placeholder-block"><span>Womenswear image</span></div>
                        <div class="overlay">
                            <h3>Womenswear</h3>
                            <a href="#">Explore</a>
                        </div>
                    </article>
                    <article class="category-card">
                        <div class="placeholder-block"><span>Menswear image</span></div>
                        <div class="overlay">
                            <h3>Menswear</h3>
                            <a href="#">Explore</a>
                        </div>
                    </article>
                    <article class="category-card">
                        <div class="placeholder-block"><span>Accessories image</span></div>
                        <div class="overlay">
                            <h3>Accessories</h3>
                            <a href="#">Explore</a>
                        </div>
                    </article>
                </div>
            </section>

            <section class="container section trend-section">
                <h2 class="section-title" style=" font-family: 'Smooch Sans', sans-serif; font-optical-sizing: auto; font-size: 50px;">Trending Now</h2>
                <div class="product-grid">
                    <article class="product-card">
                        <div class="placeholder-block product-media">
                            <span>Product image</span>
                            <div class="tag new">NEW</div>
                        </div>

                        <h3>Amber Sunset Jacket</h3>
                        <p class="price">$120.38</p>
                        <button type="button" class="add-cart-btn">Add to Cart</button>
                    </article>
                    <article class="product-card">
                        <div class="placeholder-block product-media"><span>Product image</span></div>
                        <h3>Midnight Sleek Trouser</h3>
                        <p class="price">$85.03</p>
                        <button type="button" class="add-cart-btn">Add to Cart</button>
                    </article>
                    <article class="product-card">
                        <div class="placeholder-block product-media">
                            <span>Product image</span>
                            <div class="tag low">LOW STOCK</div>
                        </div>
                        <h3>Olive Urban Tee</h3>
                        <p class="price">$45.78</p>
                        <button type="button" class="add-cart-btn">Add to Cart</button>
                    </article>
                    <article class="product-card">
                        <div class="placeholder-block product-media"><span>Product image</span></div>
                        <h3>Crimson Crossbody Bag</h3>
                        <p class="price">$63.03</p>
                        <button type="button" class="add-cart-btn">Add to Cart</button>
                    </article>
                </div>
            </section>
        </main>
    </div>

    <script src="{{ asset('js/landing.js') }}"></script>

</body>

</html>
