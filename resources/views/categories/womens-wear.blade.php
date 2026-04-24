<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aura - Categories</title>
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
</head>
<body class="aura">
    <header class="aura-header">
        <div class="aura-container aura-header__inner">
            <a class="aura-brand" href="/" aria-label="Aura home">
                <span class="aura-brand__mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="20" height="20" role="img" aria-hidden="true">
                        <path fill="currentColor" d="M6 7a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v1h-2V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v1H6V7zm0 3h12l1.2 10.2A2 2 0 0 1 17.2 22H6.8a2 2 0 0 1-1.99-1.8L6 10zm4 2a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4z"/>
                    </svg>
                </span>
                <span class="aura-brand__name">Aura</span>
            </a>

            <button class="aura-menu-toggle" id="auraMenuToggle" type="button" aria-expanded="false" aria-controls="auraNav">
                Menu
            </button>

            <nav class="aura-nav" id="auraNav" aria-label="Primary navigation">
                <a class="aura-nav__link" href="/">Home</a>
                <a class="aura-nav__link aura-nav__link--active" href="/categories/womens-wear" aria-current="page">Categories</a>
                <a class="aura-nav__link" href="#">New Arrivals</a>
                <a class="aura-nav__link" href="#sale" id="saleNavLink">Sale</a>
            </nav>

            <div class="aura-actions" aria-label="Quick actions">
                <button class="aura-icon-btn" type="button" aria-label="Search">
                    <svg viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true">
                        <path fill="currentColor" d="M10 4a6 6 0 1 1 3.74 10.7l4.78 4.78-1.42 1.42-4.78-4.78A6 6 0 0 1 10 4zm0 2a4 4 0 1 0 0 8a4 4 0 0 0 0-8z"/>
                    </svg>
                </button>
                <button class="aura-icon-btn" type="button" aria-label="Account">
                    <svg viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true">
                        <path fill="currentColor" d="M12 12a4 4 0 1 0-4-4a4 4 0 0 0 4 4zm0 2c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5z"/>
                    </svg>
                </button>
                <button class="aura-icon-btn aura-cart" type="button" aria-label="Cart">
                    <svg viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true">
                        <path fill="currentColor" d="M7 6h14l-2 9H8L6.6 2H3v2h2l2.2 11h12.3l2.6-11H7V6zm2 16a2 2 0 1 1 0-4a2 2 0 0 1 0 4zm10 0a2 2 0 1 1 0-4a2 2 0 0 1 0 4z"/>
                    </svg>
                    <span class="aura-cart__dot" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </header>

    <section class="aura-page-header">
        <div class="aura-container aura-page-header__inner">
            <nav class="aura-breadcrumbs" aria-label="Breadcrumb">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="/categories/womens-wear">Categories</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" id="activeCategoryLabel">Women's Wear</li>
                </ol>
            </nav>

            <h1 class="aura-title" id="categoryTitle">Women's Wear</h1>

            <div class="aura-filters" role="tablist" aria-label="Category filters" id="categoryTabs">
                <button class="aura-pill is-active" type="button" role="tab" aria-selected="true" data-category="Women's Wear">Women's Wear</button>
                <button class="aura-pill" type="button" role="tab" aria-selected="false" data-category="Men's Wear">Men's Wear</button>
                <button class="aura-pill" type="button" role="tab" aria-selected="false" data-category="Shoes">Shoes</button>
                <button class="aura-pill" type="button" role="tab" aria-selected="false" data-category="Accessories">Accessories</button>
                <button class="aura-pill aura-pill--sale" type="button" role="tab" aria-selected="false" data-category="Sale" id="sale">Sale</button>
            </div>
        </div>
    </section>

    <main class="aura-container aura-main">
        <div class="aura-grid-header">
            <p class="aura-muted" id="gridCount">Showing 0 products</p>

            <div class="aura-sort">
                <span class="aura-muted">Sort by:</span>
                <label class="sr-only" for="sortBy">Sort products</label>
                <select id="sortBy" class="aura-select">
                    <option value="newest" selected>Newest Arrivals</option>
                    <option value="price-asc">Price: Low to High</option>
                    <option value="price-desc">Price: High to Low</option>
                    <option value="name-asc">Name: A-Z</option>
                </select>
            </div>
        </div>

        <section class="aura-grid" aria-label="Product grid" id="productGrid"></section>
    </main>

    <script src="{{ asset('js/product-store.js') }}"></script>
    <script src="{{ asset('js/category.js') }}"></script>
</body>
</html>
