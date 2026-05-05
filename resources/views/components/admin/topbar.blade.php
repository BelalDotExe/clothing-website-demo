<header class="topbar">
    <div class="topbar-left">
        <button class="sidebar-toggle" type="button" id="sidebarToggle" aria-label="Toggle menu">
            <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z"/></svg>
        </button>
        <h1>@yield('page_title', 'Dashboard')</h1>
    </div>
    <div class="topbar-right">
        <div class="search-bar" role="search">
            <span class="search-bar__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M10 4a6 6 0 1 1 3.74 10.7l4.78 4.78l-1.42 1.42l-4.78-4.78A6 6 0 0 1 10 4m0 2a4 4 0 1 0 0 8a4 4 0 0 0 0-8"/></svg>
            </span>
            <span>Search products, orders...</span>
        </div>

        <div class="topbar-user-wrap">
            <button class="icon-circle" type="button" aria-label="Notifications">
                <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M12 22a2.5 2.5 0 0 0 2.45-2h-4.9A2.5 2.5 0 0 0 12 22M6 18h12v-1l-2-2v-4.5A4 4 0 0 0 12 6a4 4 0 0 0-4 4.5V15l-2 2z"/></svg>
                <span class="notif-dot" aria-hidden="true"></span>
            </button>
            <div class="divider"></div>
            <button class="user-avatar" type="button" aria-label="User menu">
                <span>A</span>
            </button>
        </div>
    </div>
</header>
