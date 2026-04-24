<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Aura</title>
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body class="dashboard-page">
    <div class="dashboard-wrapper">
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
                <a class="nav-item nav-item--logout" href="/admin/login">
                    <span class="nav-item__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="m16 17l1.41-1.41L14.83 13H21v-2h-6.17l2.58-2.59L16 7l-5 5zm-10 3h8v2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h8v2H6z"/></svg>
                    </span>
                    Log Out
                </a>
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
                        <button class="user-chip" type="button" aria-label="User menu">
                            <span class="avatar" aria-hidden="true">SA</span>
                            <span class="user-text">
                                <strong>Sarah Admin</strong>
                                <small>Store Manager</small>
                            </span>
                            <span class="chev" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="m7 10l5 5l5-5z"/></svg>
                            </span>
                        </button>
                    </div>
                </div>
            </header>

            <div class="content-area">
                <div class="heading-row">
                    <h2>Dashboard</h2>
                    <button class="btn btn-outline" type="button">
                        <span aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M5 20h14v-2H5zm7-18l-5.5 5.5h3.5V16h4V7.5h3.5z"/></svg>
                        </span>
                        Export Report
                    </button>
                </div>

                <section class="grid-3" aria-label="Key metrics">
                    <article class="metric-card">
                        <div class="metric-header">
                            <div>
                                <p class="metric-title">Total Sales Income</p>
                                <p class="metric-value">$45,231.89</p>
                            </div>
                            <span class="icon-wrapper icon-green" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9s9-4.03 9-9s-4.03-9-9-9m1 15h-2v-1H9v-2h2v-2H9V9h2V8h2v1h2v2h-2v2h2v2h-2z"/></svg>
                            </span>
                        </div>
                        <p class="metric-subtitle positive">+12.5% <span>from last month</span></p>
                    </article>

                    <article class="metric-card">
                        <div class="metric-header">
                            <div>
                                <p class="metric-title">Pending Orders</p>
                                <p class="metric-value">24</p>
                            </div>
                            <span class="icon-wrapper icon-orange" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M7 6h14l-2 9H8L6.6 2H3v2h2l2.2 11h12.3l2.6-11H7V6z"/></svg>
                            </span>
                        </div>
                        <p class="metric-subtitle"><strong>5 orders</strong> <span>need urgent fulfillment</span></p>
                    </article>

                    <article class="metric-card">
                        <div class="metric-header">
                            <div>
                                <p class="metric-title">Inventory Items</p>
                                <p class="metric-value">1,245</p>
                            </div>
                            <span class="icon-wrapper icon-teal" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M20.54 5.23L19.15 4l-1.92 1.1L15.3 4l-1.39 1.23l.8 2.12L12.8 8.5l.58 2.2l2.25.08L17 12.7l1.37-1.92l2.25-.08l.58-2.2l-1.91-1.15zM9 3L3 6v6c0 5.55 3.84 10.74 9 12c5.16-1.26 9-6.45 9-12V6z"/></svg>
                            </span>
                        </div>
                        <p class="metric-subtitle"><strong>18 Categories</strong> <span>active in store</span></p>
                    </article>
                </section>

                <section class="grid-layout" aria-label="Inventory management">
                    <article class="panel">
                        <header class="panel-header">
                            <h3 class="panel-title">Low Stock Items</h3>
                            <button class="btn btn-outline btn-sm" type="button">View All Alerts</button>
                        </header>
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="product-cell">
                                                <span class="product-img" aria-hidden="true"></span>
                                                <span class="product-info">
                                                    <strong class="product-name">Olive Green Chinos</strong>
                                                    <small class="product-sku">SKU: AU-1092</small>
                                                </span>
                                            </div>
                                        </td>
                                        <td><span class="table-meta">Men's Wear</span></td>
                                        <td><span class="badge badge-destructive">Critical</span></td>
                                        <td><strong class="stock-danger">2 Left</strong></td>
                                        <td><button class="btn btn-outline btn-sm" type="button">Update</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product-cell">
                                                <span class="product-img" aria-hidden="true"></span>
                                                <span class="product-info">
                                                    <strong class="product-name">Oversized Knit Sweater</strong>
                                                    <small class="product-sku">SKU: AU-2841</small>
                                                </span>
                                            </div>
                                        </td>
                                        <td><span class="table-meta">Women's Wear</span></td>
                                        <td><span class="badge badge-warning">Low</span></td>
                                        <td><strong class="stock-warn">5 Left</strong></td>
                                        <td><button class="btn btn-outline btn-sm" type="button">Update</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product-cell">
                                                <span class="product-img" aria-hidden="true"></span>
                                                <span class="product-info">
                                                    <strong class="product-name">Leather Crossbody Bag</strong>
                                                    <small class="product-sku">SKU: AU-4019</small>
                                                </span>
                                            </div>
                                        </td>
                                        <td><span class="table-meta">Accessories</span></td>
                                        <td><span class="badge badge-destructive">Critical</span></td>
                                        <td><strong class="stock-danger">1 Left</strong></td>
                                        <td><button class="btn btn-outline btn-sm" type="button">Update</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product-cell">
                                                <span class="product-img" aria-hidden="true"></span>
                                                <span class="product-info">
                                                    <strong class="product-name">Canvas Sneakers</strong>
                                                    <small class="product-sku">SKU: AU-5103</small>
                                                </span>
                                            </div>
                                        </td>
                                        <td><span class="table-meta">Shoes</span></td>
                                        <td><span class="badge badge-warning">Low</span></td>
                                        <td><strong class="stock-warn">4 Left</strong></td>
                                        <td><button class="btn btn-outline btn-sm" type="button">Update</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </article>

                    <article class="panel panel--catalog">
                        <div>
                            <div class="catalog-top">
                                <div class="catalog-img" aria-hidden="true"></div>
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

