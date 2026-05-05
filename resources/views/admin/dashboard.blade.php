@extends('layouts.admin')

@section('title', 'Dashboard - Aura Admin')
@section('body_class', 'dashboard-page')
@section('page_title', 'Overview')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endpush

@section('content')
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
@endsection

@push('scripts')
    <script src="{{ asset('js/admin-dashboard.js') }}"></script>
@endpush
