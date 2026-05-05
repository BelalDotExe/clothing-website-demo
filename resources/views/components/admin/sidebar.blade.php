<aside class="sidebar" id="dashboardSidebar">
    <div class="sidebar-brand">
        <span class="sidebar-brand__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="20" height="20" role="img" aria-hidden="true">
                <path fill="currentColor" d="M6 7a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v1h-2V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v1H6V7zm0 3h12l1.2 10.2A2 2 0 0 1 17.2 22H6.8a2 2 0 0 1-1.99-1.8L6 10zm4 2a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4z"/>
            </svg>
        </span>
        <span class="sidebar-brand__name">Aura</span>
    </div>

    <div class="sidebar-nav-wrap">
        <p class="sidebar-label">Main Menu</p>
        <a class="nav-item @if(Request::is('admin/dashboard')) active @endif" href="/admin/dashboard">
            <span class="nav-item__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M3 13h8V3H3zm10 8h8V11h-8zM3 21h8v-6H3zm10-18v6h8V3z"/></svg>
            </span>
            Dashboard
        </a>
        <a class="nav-item @if(Request::is('admin/products')) active @endif" href="/admin/products">
            <span class="nav-item__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M20 6H4V4h16zm0 4H4V8h16zm-6 4H4v-2h10zm6 0h-4v-2h4zm0 4H4v-2h16z"/></svg>
            </span>
            Products
        </a>
        <a class="nav-item" href="#">
            <span class="nav-item__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M10 4H4v6h6zm10 0h-6v6h6zM10 14H4v6h6zm10 0h-6v6h6z"/></svg>
            </span>
            Categories
        </a>
        <a class="nav-item nav-item--split" href="#">
            <span class="nav-item__left">
                <span class="nav-item__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M7 6h14l-2 9H8L6.6 2H3v2h2l2.2 11h12.3l2.6-11H7V6z"/></svg>
                </span>
                Orders
            </span>
            <span class="count-pill">24</span>
        </a>
        <a class="nav-item" href="#">
            <span class="nav-item__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M16 11a4 4 0 1 0-8 0a4 4 0 0 0 8 0zm-4 6c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5z"/></svg>
            </span>
            Customers
        </a>

        <p class="sidebar-label sidebar-label--system">System</p>
        <a class="nav-item" href="#">
            <span class="nav-item__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="m19.14 12.94l1.43-1.11l-1.43-1.11l.35-1.77l-1.77-.35l-1.11-1.43l-1.11 1.43l-1.77.35l.35 1.77l-1.43 1.11l1.43 1.11l-.35 1.77l1.77.35l1.11 1.43l1.11-1.43l1.77-.35zM10 4h8V2H6v20h8v-2h-6V4z"/></svg>
            </span>
            Settings
        </a>
    </div>

    <div class="sidebar-footer">
        <form method="post" action="{{ route('admin.logout') }}">
            @csrf
            <button class="nav-item nav-item--logout" type="submit" style="width:100%; border:0; background:transparent; text-align:left; cursor:pointer;">
                <span class="nav-item__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="m16 17l1.41-1.41L14.83 13H21v-2h-6.17l2.58-2.59L16 7l-5 5zm-10 3h8v2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h8v2H6z"/></svg>
                </span>
                Log Out
            </button>
        </form>
    </div>
</aside>
