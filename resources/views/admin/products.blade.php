<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products - Aura Admin</title>
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
                <a class="nav-item" href="/admin/dashboard">
                    <span class="nav-item__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M3 13h8V3H3zm10 8h8V11h-8zM3 21h8v-6H3zm10-18v6h8V3z"/></svg>
                    </span>
                    Dashboard
                </a>
                <a class="nav-item active" href="/admin/products">
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
                    <h1>Products</h1>
                </div>
                <div class="topbar-right">
                    <div class="search-bar">
                        <span class="search-bar__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M10 4a6 6 0 1 1 3.74 10.7l4.78 4.78l-1.42 1.42l-4.78-4.78A6 6 0 0 1 10 4m0 2a4 4 0 1 0 0 8a4 4 0 0 0 0-8"/></svg>
                        </span>
                        <label class="sr-only" for="productSearch">Search products</label>
                        <input id="productSearch" type="search" placeholder="Search products..." />
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
                <section id="productListView">
                    <div class="heading-row">
                        <div>
                            <h2>Product Inventory</h2>
                            <p id="inventorySummary">Manage all products in your catalog.</p>
                        </div>
                        <button class="btn btn-primary" type="button" id="openAddProductBtn">
                            <span aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/></svg>
                            </span>
                            Add New Product
                        </button>
                    </div>

                    <section class="panel" aria-label="Products table">
                        <div class="toolbar">
                            <div class="filter-group">
                                <label class="sr-only" for="categoryFilter">Category filter</label>
                                <select class="select-input" id="categoryFilter">
                                    <option value="all">All Categories</option>
                                </select>
                                <label class="sr-only" for="stockFilter">Stock filter</label>
                                <select class="select-input" id="stockFilter">
                                    <option value="all">Stock Status</option>
                                    <option value="in-stock">In Stock</option>
                                    <option value="low-stock">Low Stock</option>
                                    <option value="out-of-stock">Out of Stock</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock Status</th>
                                        <th class="actions-th">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="productTableBody"></tbody>
                            </table>
                        </div>

                        <div class="pagination">
                            <p id="paginationSummary"></p>
                            <div class="pagination-actions">
                                <button class="btn btn-outline is-disabled" type="button" disabled>Previous</button>
                                <button class="btn btn-outline is-disabled" type="button" disabled>Next</button>
                            </div>
                        </div>
                    </section>
                </section>

                <section id="productEditorView" class="is-hidden" aria-live="polite">
                    <div class="editor-heading-row">
                        <div class="editor-heading-left">
                            <button class="btn-icon btn-icon-solid" type="button" id="editorBackBtn" aria-label="Back to products">
                                <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="m14 7l-5 5l5 5v-3h7v-4h-7z"/></svg>
                            </button>
                            <div class="editor-title-wrap">
                                <h2 id="editorTitle">Add New Product</h2>
                                <p id="editorSubtitle">Create a new product item in your catalog.</p>
                            </div>
                        </div>
                        <div class="editor-actions">
                            <button class="btn btn-outline" type="button" id="editorCancelBtn">Cancel</button>
                            <button class="btn btn-primary" type="submit" form="productEditorForm" id="editorSaveBtn">Save Product</button>
                        </div>
                    </div>

                    <form id="productEditorForm" novalidate>
                        <input type="hidden" id="productId" name="productId">
                        <div class="editor-grid">
                            <div class="editor-main-col">
                                <section class="panel editor-panel">
                                    <h3 class="editor-panel__title">Basic Information</h3>

                                    <div class="form-group">
                                        <label for="productName">Product Name</label>
                                        <input class="input-field" id="productName" name="productName" type="text" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="productDescription">Description</label>
                                        <textarea class="textarea-field" id="productDescription" name="productDescription"></textarea>
                                    </div>

                                    <div class="field-row">
                                        <div class="form-group">
                                            <label for="productPrice">Price ($)</label>
                                            <input class="input-field" id="productPrice" name="productPrice" type="number" min="0" step="0.01" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="productStock">Stock</label>
                                            <input class="input-field" id="productStock" name="productStock" type="number" min="0" step="1" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="productSku">SKU</label>
                                            <input class="input-field" id="productSku" name="productSku" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="productDiscount">Discount Percentage</label>
                                        <div class="discount-input-wrap">
                                            <input class="input-field" id="productDiscount" name="productDiscount" type="number" min="0" max="100" step="1" value="0">
                                            <span class="discount-suffix">%</span>
                                        </div>
                                        <p class="field-help">Set to 0 if there is no discount. Discounted products also appear in the Sale tab.</p>
                                    </div>
                                </section>
                            </div>

                            <div class="editor-side-col">
                                <section class="panel editor-panel">
                                    <h3 class="editor-panel__title">Product Image</h3>
                                    <img id="productImagePreview" class="product-preview" src="" alt="Product preview">
                                    <div class="form-group">
                                        <label for="productImage">Image URL</label>
                                        <input class="input-field" id="productImage" name="productImage" type="url" placeholder="https://example.com/image.jpg">
                                    </div>
                                </section>

                                <section class="panel editor-panel">
                                    <h3 class="editor-panel__title">Category &amp; Status</h3>
                                    <div class="form-group">
                                        <label for="productCategory">Category</label>
                                        <select class="input-field" id="productCategory" name="productCategory"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="productStatus">Status</label>
                                        <select class="input-field" id="productStatus" name="productStatus">
                                            <option value="Active (In Stock)">Active (In Stock)</option>
                                            <option value="Active (Low Stock)">Active (Low Stock)</option>
                                            <option value="Out of Stock">Out of Stock</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/product-store.js') }}"></script>
    <script src="{{ asset('js/admin-products.js') }}"></script>
</body>
</html>
