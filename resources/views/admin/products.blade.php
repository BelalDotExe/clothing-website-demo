<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Products - H&B Clothing Admin</title>
    <link rel="preload" href="{{ asset('fonts/logo-font.otf') }}" as="font" type="font/otf" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/admin-products.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="dashboard-page">
    <div class="dashboard-wrapper">
        <aside class="sidebar" id="dashboardSidebar">
            <div class="sidebar-brand">
                <span class="sidebar-brand__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M6 7a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v1h-2V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v1H6V7zm0 3h12l1.2 10.2A2 2 0 0 1 17.2 22H6.8a2 2 0 0 1-1.99-1.8L6 10zm4 2a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4z"/></svg>
                </span>
                <span class="sidebar-brand__name">H&B Clothing</span>
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
                    <h1>Products</h1>
                </div>
                <div class="topbar-right">
                    <div class="topbar-user-wrap">
                        <div class="hb-notif">
                            <button class="icon-circle hb-notif-btn" type="button" aria-label="Notifications">
                                <i class="fa-regular fa-bell"></i>
                                <span class="notif-dot hb-notif-dot" aria-hidden="true"></span>
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
                @if (session('ok'))
                    <p style="color:#16a34a; margin-bottom:12px;">{{ session('ok') }}</p>
                @endif
                @if ($errors->any())
                    <div style="color:#b91c1c; background:#fee2e2; border:1px solid #fecaca; padding:12px; border-radius:10px; margin-bottom:12px;">
                        <strong>Could not save product:</strong>
                        <ul style="margin:8px 0 0 18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <section id="productListView" class="{{ $errors->any() ? 'is-hidden' : '' }}">
                    <div class="heading-row">
                        <div>
                            <h2>Product Inventory</h2>
                            <p id="inventorySummary">Manage all products in your catalog.</p>
                        </div>
                        <button class="btn btn-primary" type="button" id="openAddProductBtn">
                            <span>
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
                                <tbody id="productTableBody">
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="product-cell">
                                                    @if (!empty($product->image))
                                                        <img class="product-img" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                                                    @endif
                                                    <span class="product-info">
                                                        <strong class="product-name">{{ $product->name }}</strong>
                                                    </span>
                                                </div>
                                            </td>
                                            <td><span class="cell-meta">{{ $product->categoryRelation?->name ?? $product->category ?? "Women's Wear" }}</span></td>
                                            <td><strong class="cell-price">${{ number_format((float) $product->price, 2) }}</strong></td>
                                            <td>
                                                @if ($product->in_stock)
                                                    <span class="badge badge-success">In Stock</span>
                                                @else
                                                    <span class="badge badge-destructive">Out of Stock</span>
                                                @endif
                                            </td>
                                            <td class="actions-td">
                                                <button
                                                    class="btn-icon"
                                                    type="button"
                                                    aria-label="Edit item"
                                                    data-action="edit"
                                                    data-id="{{ $product->id }}"
                                                    data-name="{{ $product->name }}"
                                                    data-price="{{ $product->price }}"
                                                    data-stock="{{ $product->stock ?? 0 }}"
                                                    data-category-id="{{ $product->category_id ?? '' }}"
                                                    data-discount="{{ $product->discount ?? 0 }}"
                                                    data-image-url="{{ !empty($product->image) ? asset('storage/'.$product->image) : '' }}"
                                                >
                                                    <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M3 17.25V21h3.75l11-11.03l-3.75-3.75zM20.7 7.04a1 1 0 0 0 0-1.41L18.37 3.3a1 1 0 0 0-1.41 0l-1.83 1.83l3.75 3.75z"/></svg>
                                                </button>
                                                <form method="post" action="{{ route('admin.products.delete', $product) }}" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn-icon btn-icon-danger" type="submit" onclick="return confirm('Delete this item?')">
                                                        <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M6 7h12l-1 14H7zm3-3h6l1 2H8z"/></svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="empty-row">No products found in database.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
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

                <section id="productEditorView" class="{{ $errors->any() ? '' : 'is-hidden' }}" aria-live="polite">
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
                            <button class="btn btn-primary" type="submit" form="productEditorForm" id="editorSaveBtn" {{ $categories->isEmpty() ? 'disabled' : '' }}>Save Product</button>
                        </div>
                    </div>

                    <!-- ============ form begins here ==================== -->
                    <form id="productEditorForm" method="post" action="{{ route('admin.products.store') }}" data-store-action="{{ route('admin.products.store') }}" data-update-action-template="{{ url('/admin/products/PRODUCT-ID-TOKEN') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <input type="hidden" id="productFormMethod" name="_method" value="PUT" disabled>
                        <input type="hidden" id="productId" name="product_id">
                        <div class="editor-grid">
                            <div class="editor-main-col">
                                <section class="panel editor-panel">
                                    <h3 class="editor-panel__title">Basic Information</h3>

                                    <div class="form-group">
                                        <label for="productName">Product Name</label>
                                        <input class="input-field" id="productName" name="name" type="text" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="productDescription">Description</label>
                                        <textarea class="textarea-field" id="productDescription" name="productDescription">{{ old('productDescription') }}</textarea>
                                    </div>

                                    <div class="field-row">
                                        <div class="form-group">
                                            <label for="productPrice">Price ($)</label>
                                            <input class="input-field" id="productPrice" name="price" type="number" min="0" step="0.01" value="{{ old('price') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="productStock">Stock</label>
                                            <input class="input-field" id="productStock" name="stock" type="number" min="0" step="1" value="{{ old('stock') }}" required>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="productDiscount">Discount Percentage</label>
                                        <div class="discount-input-wrap">
                                            <input class="input-field" id="productDiscount" name="discount" type="number" min="0" max="100" step="1" value="{{ old('discount', 0) }}">
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
                                        <label for="productImage">Product Image</label>
                                        <div class="upload-box">
                                            <input id="productImage" name="image" type="file" accept="image/*" class="upload-input">
                                            <label for="productImage" class="upload-label">
                                                <strong style="color:white;">Choose image</strong>
                                            </label>
                                        </div>
                                    </div>

                                </section>

                                <section class="panel editor-panel">
                                    <h3 class="editor-panel__title">Category &amp; Status</h3>
                                    <div class="form-group">
                                        <label for="productCategory">Category</label>
                                        <select class="input-field" id="productCategory" name="category_id" required>
                                            @forelse ($categories as $category)
                                                <option value="{{ $category->id }}" {{ (string) old('category_id') === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @empty
                                                <option value="">No categories available</option>
                                            @endforelse
                                        </select>
                                        @if ($categories->isEmpty())
                                            <p class="field-help" style="color:#b45309;">Create at least one category first, then add products.</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="productStatus">Status</label>
                                        <select class="input-field" id="productStatus" name="productStatus">
                                            <option value="Active (In Stock)">Active (In Stock)</option>
                                            <option value="Out of Stock">Out of Stock</option>
                                        </select>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </form>
                    <!-- ================= form ends here ======================== -->
                </section>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/admin-products.js') }}"></script>
</body>
</html>
