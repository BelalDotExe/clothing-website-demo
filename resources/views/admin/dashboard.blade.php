<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - H&B Clothing</title>
    <link rel="preload" href="{{ asset('fonts/logo-font.otf') }}" as="font" type="font/otf" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="dashboard-page">
    @php
        $totalRevenue = isset($totalRevenue) ? (float) $totalRevenue : (float) \App\Models\Order::sum('total_amount');
        $totalItemsSold = isset($totalItemsSold) ? (int) $totalItemsSold : (int) \App\Models\Order::sum('total_items');
        $inventoryItems = isset($inventoryItems) ? (int) $inventoryItems : (int) \App\Models\Product::sum('stock');
        $categoriesCount = isset($categoriesCount) ? (int) $categoriesCount : (int) \App\Models\Category::count();
    @endphp
    <div class="dashboard-wrapper">
        <aside class="sidebar" id="dashboardSidebar">
            <div class="sidebar-brand">
                <span class="sidebar-brand__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="20" height="20" role="img" aria-hidden="true">
                        <path fill="currentColor" d="M6 7a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v1h-2V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v1H6V7zm0 3h12l1.2 10.2A2 2 0 0 1 17.2 22H6.8a2 2 0 0 1-1.99-1.8L6 10zm4 2a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4z"/>
                    </svg>
                </span>
                <span class="sidebar-brand__name">H&B Clothing</span>
            </div>

            <div class="sidebar-nav-wrap">
                <p class="sidebar-label">Main Menu</p>
                <a class="nav-item active" href="/admin/dashboard">
                    <span class="nav-item__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M3 13h8V3H3zm10 8h8V11h-8zM3 21h8v-6H3zm10-18v6h8V3z"/></svg>
                    </span>
                    Dashboard
                </a>
                <a class="nav-item" href="/admin/products">
                    <span class="nav-item__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M20 6H4V4h16zm0 4H4V8h16zm-6 4H4v-2h10zm6 0h-4v-2h4zm0 4H4v-2h16z"/></svg>
                    </span>
                    Products
                </a>
                <a class="nav-item" href="{{ route('admin.categories') }}">
                    <span class="nav-item__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M10 4H4v6h6zm10 0h-6v6h6zM10 14H4v6h6zm10 0h-6v6h6z"/></svg>
                    </span>
                    Categories
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

        <main class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle" type="button" id="sidebarToggle" aria-label="Toggle menu">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z"/></svg>
                    </button>
                    <h1>Overview</h1>
                </div>
                <div class="topbar-right">
                    <div class="topbar-user-wrap">
                        <div class="hb-notif">
                            <button class="icon-circle hb-notif-btn" type="button" aria-label="Notifications">
                                <i class="fa-regular fa-bell"></i>
                                <span class="notif-dot hb-notif-dot"></span>
                            </button>
                            <div class="hb-notif-panel" hidden>
                                <div class="hb-notif-head">
                                    <strong>Notifications</strong>
                                    <button class="hb-notif-clear" type="button">Delete All</button>
                                </div>
                                <div class="hb-notif-list"></div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <button class="user-chip" type="button">
                            <span class="avatar" ><i class="fa-regular fa-user"></i></span>
                            <span class="user-text">
                               <strong>{{ auth()->user()->user }}</strong>
                               <small>Store Admin</small>
                            </span>
                        </button>
                    </div>
                </div>
            </header>

            <div class="content-area">
                <div class="heading-row">
                    <h2>Dashboard</h2>
                    <a class="btn btn-outline" href="{{ route('admin.products') }}">Manage Products</a>
                </div>

                <section class="grid-3" aria-label="Key metrics">
                    <article class="metric-card">
                        <div class="metric-header">
                            <div>
                                <p class="metric-title">Total Sales Income</p>
                                <p class="metric-value">${{ number_format((float) $totalRevenue, 2) }}</p>
                            </div>
                            <span class="icon-wrapper icon-green" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9s9-4.03 9-9s-4.03-9-9-9m1 15h-2v-1H9v-2h2v-2H9V9h2V8h2v1h2v2h-2v2h2v2h-2z"/></svg>
                            </span>
                        </div>
                        <p class="metric-subtitle"><strong>{{ number_format((float) $totalRevenue, 2) }}</strong> <span>recorded from orders table</span></p>
                    </article>

                    <article class="metric-card">
                        <div class="metric-header">
                            <div>
                                <p class="metric-title">Total Items Sold</p>
                                <p class="metric-value">{{ $totalItemsSold }}</p>
                            </div>
                            <span class="icon-wrapper icon-orange" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M7 6h14l-2 9H8L6.6 2H3v2h2l2.2 11h12.3l2.6-11H7V6z"/></svg>
                            </span>
                        </div>
                        <p class="metric-subtitle"><strong>{{ $totalItemsSold }}</strong> <span>items sold through checkout</span></p>
                    </article>

                    <article class="metric-card">
                        <div class="metric-header">
                            <div>
                                <p class="metric-title">Inventory Items</p>
                                <p class="metric-value">{{ $inventoryItems }}</p>
                            </div>
                            <span class="icon-wrapper icon-teal" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M20.54 5.23L19.15 4l-1.92 1.1L15.3 4l-1.39 1.23l.8 2.12L12.8 8.5l.58 2.2l2.25.08L17 12.7l1.37-1.92l2.25-.08l.58-2.2l-1.91-1.15zM9 3L3 6v6c0 5.55 3.84 10.74 9 12c5.16-1.26 9-6.45 9-12V6z"/></svg>
                            </span>
                        </div>
                        <p class="metric-subtitle"><strong>{{ $categoriesCount }} Categories</strong> <span>active in store</span></p>
                    </article>
                </section>

                <section class="grid-layout" aria-label="Inventory management">


                    <article class="panel panel--catalog">
                        <div>
                            <div class="catalog-top">
                                <div class="catalog-img">
                                    <img src="{{asset('images/hero-alt.png')}}" alt="">
                                </div>
                                <div class="catalog-overlay"></div>
                                <h3>Catalog Management</h3>
                            </div>
                            <div class="catalog-body">
                                <p>
                                    Keep your store updated. Add new arrivals, edit existing
                                    products, update pricing, or remove out-of-stock items to
                                    ensure a seamless shopping experience for your customers.
                                </p>
                                <ul class="catalog-list">
                                    <li><span class="catalog-icon">+</span><span>Add new products</span></li>
                                    <li><span class="catalog-icon">E</span><span>Edit existing details</span></li>
                                    <li><span class="catalog-icon">X</span><span>Remove discontinued items</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="catalog-footer">
                            <a class="btn btn-primary btn-full" href="/admin/products">
                                Manage All Items
                                <span aria-hidden="true">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="m13 5l7 7l-7 7l-1.4-1.4l4.6-4.6H4v-2h12.2l-4.6-4.6z"/></svg>
                                </span>
                            </a>
                        </div>
                    </article>
                </section>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/admin-dashboard.js') }}"></script>
</body>
</html>
