<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H&B Clothing - Categories</title>
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
</head>
<body class="aura">
    <header class="aura-header">
        <div class="aura-container aura-header__inner">
            <a class="aura-brand" href="/">
                <span class="aura-brand__mark">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <path fill="currentColor" d="M6 7a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v1h-2V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v1H6V7zm0 3h12l1.2 10.2A2 2 0 0 1 17.2 22H6.8a2 2 0 0 1-1.99-1.8L6 10zm4 2a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4z"/>
                    </svg>
                </span>
                <span class="aura-brand__name">H&B Clothing</span>
            </a>

            <button class="aura-menu-toggle" id="hbMenuToggle" type="button" aria-expanded="false" aria-controls="hbNav">
                Menu
            </button>

            <nav class="aura-nav" id="hbNav">
                <a class="aura-nav__link" href="/">Home</a>
                <a class="aura-nav__link aura-nav__link--active" href="/categories/womens-wear" data-nav-tab="categories">Categories</a>
                <a class="aura-nav__link" href="/categories/womens-wear#sale" data-nav-tab="sale">Sale</a>

            </nav>

            <div class="aura-actions">
                <a class="aura-icon-btn" href="/admin/login">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </a>
                <a class="aura-icon-btn aura-cart" href="/cart">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                        <path d="M3 6h18"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    <span class="aura-cart__dot" id="hbCartCount">0</span>
                </a>
            </div>
        </div>
    </header>

    <section class="aura-page-header">
        @php
            $defaultCategory = $categories->first()->name ?? 'Sale';
        @endphp
        <div class="aura-container aura-page-header__inner">
            <nav class="aura-breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li><a href="/categories/womens-wear">Categories</a></li>
                    <li>/</li>
                    <li id="activeCategoryLabel">{{ $defaultCategory }}</li>
                </ol>
            </nav>
            <h1 class="aura-title" id="categoryTitle">{{ $defaultCategory }}</h1>

            <div class="aura-filters" id="categoryTabs">
                @foreach ($categories as $category)
                    <button class="aura-pill {{ $loop->first ? 'is-active' : '' }}" type="button" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-category="{{ $category->name }}">{{ $category->name }}</button>
                @endforeach
                <button class="aura-pill aura-pill--sale" type="button" role="tab" aria-selected="false" data-category="Sale" id="sale">Sale</button>
            </div>
        </div>
    </section>

    <main class="aura-container aura-main">
        <div class="aura-grid-header">
            <p class="aura-muted" id="gridCount">Showing 0 products</p>

            <div class="aura-sort">
                <span class="aura-muted">Sort by:</span>
                <select id="sortBy" class="aura-select">
                    <option value="newest" selected>Newest Arrivals</option>
                    <option value="price-asc">Price: Low to High</option>
                    <option value="price-desc">Price: High to Low</option>
                    <option value="name-asc">Name: A-Z</option>
                </select>
            </div>
        </div>

        <section class="aura-grid" id="productGrid"></section>
    </main>

    <script>
        window.hbProducts = @json($products);
        window.hbDefaultCategory = @json($defaultCategory);
    </script>
    <script src="{{ asset('js/category.js') }}"></script>
</body>
</html>
