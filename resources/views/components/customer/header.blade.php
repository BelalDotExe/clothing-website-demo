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
            <a class="lp-nav__link @if(Request::path() === '/') lp-nav__link--active @endif" href="/" @if(Request::path() === '/') aria-current="page" @endif>Home</a>
            <a class="lp-nav__link @if(str_contains(Request::path(), 'categories')) lp-nav__link--active @endif" href="/categories/womens-wear">Categories</a>
            <a class="lp-nav__link" href="#">New Arrivals</a>
        </nav>

        <div class="lp-actions" aria-label="Quick actions">
            <button class="lp-icon-btn" type="button" aria-label="Search">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" role="img" aria-hidden="true">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
            </button>
            <a class="lp-icon-btn" href="/admin/login" aria-label="Admin">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" role="img" aria-hidden="true">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </a>
            <a class="lp-icon-btn" href="/cart">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" role="img" aria-hidden="true">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                    <path d="M3 6h18"/>
                    <path d="M16 10a4 4 0 0 1-8 0"/>
                </svg>
            </a>
        </div>
    </div>
</header>
