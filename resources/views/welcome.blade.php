<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chroma - Wear Your True Colors</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>
    <div class="site-wrap">
        <header class="lp-header">
            <div class="container lp-header__inner">
                <a href="/" class="lp-brand" aria-label="Home">
                    <span class="lp-brand__mark" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20" role="img" aria-hidden="true">
                            <path fill="currentColor" d="M6 7a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v1h-2V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v1H6V7zm0 3h12l1.2 10.2A2 2 0 0 1 17.2 22H6.8a2 2 0 0 1-1.99-1.8L6 10zm4 2a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4z"/>
                        </svg>
                    </span>
                    <span class="lp-brand__name">CHROMA</span>
                </a>

                <button class="lp-menu-toggle" id="auraMenuToggle" type="button" aria-expanded="false" aria-controls="auraNav">
                    Menu
                </button>

                <nav class="lp-nav" id="auraNav" aria-label="Primary navigation">
                    <a class="lp-nav__link lp-nav__link--active" href="/" aria-current="page">Home</a>
                    <a class="lp-nav__link" href="/categories/womens-wear">Categories</a>
                    <a class="lp-nav__link" href="#">New Arrivals</a>
                    <a class="lp-nav__link lp-nav__link--sale" href="/categories/womens-wear#sale">Sale</a>
                </nav>

                <div class="lp-actions" aria-label="Quick actions">
                    <button class="lp-icon-btn" type="button" aria-label="Search">
                        <svg viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true">
                            <path fill="currentColor" d="M10 4a6 6 0 1 1 3.74 10.7l4.78 4.78-1.42 1.42-4.78-4.78A6 6 0 0 1 10 4zm0 2a4 4 0 1 0 0 8a4 4 0 0 0 0-8z"/>
                        </svg>
                    </button>
                    <button class="lp-icon-btn" type="button" aria-label="Account">
                        <svg viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true">
                            <path fill="currentColor" d="M12 12a4 4 0 1 0-4-4a4 4 0 0 0 4 4zm0 2c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5z"/>
                        </svg>
                    </button>
                    <button class="lp-icon-btn lp-cart" type="button" aria-label="Cart">
                        <svg viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true">
                            <path fill="currentColor" d="M7 6h14l-2 9H8L6.6 2H3v2h2l2.2 11h12.3l2.6-11H7V6zm2 16a2 2 0 1 1 0-4a2 2 0 0 1 0 4zm10 0a2 2 0 1 1 0-4a2 2 0 0 1 0 4z"/>
                        </svg>
                        <span class="lp-cart__dot" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </header>

        <main>
            <section class="hero container">
                <div class="hero-copy">
                    <span class="eyebrow">SPRING COLLECTION 2025</span>
                    <h1>Wear Your True Colors</h1>
                    <p>
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
                <h2 class="section-title">Shop by Category</h2>
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
                <h2 class="section-title">Trending Now</h2>
                <div class="product-grid">
                    <article class="product-card">
                        <div class="tag">NEW</div>
                        <div class="placeholder-block product-media"><span>Product image</span></div>
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
                        <div class="tag low">LOW STOCK</div>
                        <div class="placeholder-block product-media"><span>Product image</span></div>
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
