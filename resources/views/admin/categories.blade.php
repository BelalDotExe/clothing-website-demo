<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categories - Aura Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin-products.css') }}">
</head>
<body class="dashboard-page">
    <div class="dashboard-wrapper">
        <aside class="sidebar" id="dashboardSidebar">
            <div class="sidebar-brand">
                <span class="sidebar-brand__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M6 7a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v1h-2V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v1H6V7zm0 3h12l1.2 10.2A2 2 0 0 1 17.2 22H6.8a2 2 0 0 1-1.99-1.8L6 10zm4 2a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4z"/></svg>
                </span>
                <span class="sidebar-brand__name">Aura</span>
            </div>

            <div class="sidebar-nav-wrap">
                <p class="sidebar-label">Main Menu</p>
                <a class="nav-item" href="{{ route('admin.dashboard') }}">
                    <span class="nav-item__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M3 13h8V3H3zm10 8h8V11h-8zM3 21h8v-6H3zm10-18v6h8V3z"/></svg>
                    </span>
                    Dashboard
                </a>
                <a class="nav-item" href="{{ route('admin.products') }}">
                    <span class="nav-item__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M20 6H4V4h16zm0 4H4V8h16zm-6 4H4v-2h10zm6 0h-4v-2h4zm0 4H4v-2h16z"/></svg>
                    </span>
                    Products
                </a>
                <a class="nav-item active" href="{{ route('admin.categories') }}">
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
                    <h1>Categories</h1>
                </div>
            </header>

            <div class="content-area">
                @if (session('ok'))
                    <p style="color:#16a34a; margin-bottom:12px;">{{ session('ok') }}</p>
                @endif

                <section class="panel" aria-label="Categories table">
                    <div class="toolbar">
                        <form method="post" action="{{ route('admin.categories.store') }}" style="display:flex; gap:12px; width:100%; flex-wrap:wrap;">
                            @csrf
                            <input class="input-field" type="text" name="name" placeholder="Add new category (e.g. Winter Wear)" style="max-width:420px;" required>
                            <button class="btn btn-primary" type="submit">Add Category</button>
                        </form>
                    </div>

                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Products</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td><span class="cell-meta">{{ $category->name }}</span></td>
                                        <td><strong class="cell-price">{{ $category->products_count }}</strong></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="empty-row">No categories found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/admin-products.js') }}"></script>
</body>
</html>
