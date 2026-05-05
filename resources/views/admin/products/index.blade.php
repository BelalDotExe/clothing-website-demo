@extends('layouts.admin')

@section('title', 'Products - Aura Admin')
@section('body_class', 'products-page')
@section('page_title', 'Products')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-products.css') }}">
@endpush

@section('content')
    <div id="productListView" class="content-area">
        <div class="heading-row">
            <div>
                <h1>Products</h1>
                <p class="field-help">Manage your product catalog, update availability, and organize inventory.</p>
            </div>
            <button class="btn btn-primary" id="openAddProductBtn">+ Add Product</button>
        </div>

        <section class="panel">
            <div class="toolbar">
                <div class="filter-group">
                    <input id="productSearch" class="input-field" type="search" placeholder="Search products...">
                    <select id="categoryFilter" class="select-input">
                        <option value="">All Categories</option>
                        <option value="Women's Wear">Women's Wear</option>
                        <option value="Men's Wear">Men's Wear</option>
                        <option value="Shoes">Shoes</option>
                        <option value="Accessories">Accessories</option>
                    </select>
                </div>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th class="actions-th">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <tr class="empty-row">
                            <td colspan="7">No products available yet.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <section id="productEditorView" class="content-area is-hidden" aria-live="polite">
        <div class="editor-heading-row">
            <div class="editor-heading-left">
                <div class="editor-title-wrap">
                    <h2 id="editorTitle">Add New Product</h2>
                    <p id="editorSubtitle">Create a new product item in your catalog.</p>
                </div>
            </div>
            <div class="editor-actions">
                <button type="button" class="btn btn-outline" id="editorBackBtn">Back to list</button>
            </div>
        </div>

        <form id="productEditorForm" method="POST" enctype="multipart/form-data"
            data-store-action="{{ route('admin.products.store') }}"
            data-update-action-template="{{ route('admin.products.update', ['product' => '__ID__']) }}">
            @csrf
            <input id="productFormMethod" type="hidden" name="_method" value="PUT" disabled>

            <div class="editor-grid">
                <div class="editor-main-col">
                    <div class="editor-panel panel">
                        <div class="editor-panel__title">Product details</div>
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input id="productName" class="input-field" type="text" name="name" required>
                        </div>

                        <div class="field-row">
                            <div class="form-group">
                                <label for="productCategory">Category</label>
                                <select id="productCategory" class="select-input" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="Women's Wear">Women's Wear</option>
                                    <option value="Men's Wear">Men's Wear</option>
                                    <option value="Shoes">Shoes</option>
                                    <option value="Accessories">Accessories</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="productPrice">Price</label>
                                <input id="productPrice" class="input-field" type="number" name="price" step="0.01" required>
                            </div>
                        </div>

                        <div class="field-row">
                            <div class="form-group">
                                <label for="productStock">Stock</label>
                                <input id="productStock" class="input-field" type="number" name="stock" required>
                            </div>

                            <div class="form-group discount-input-wrap">
                                <label for="productDiscount">Discount %</label>
                                <input id="productDiscount" class="input-field" type="number" name="discount" min="0" max="100">
                                <span class="discount-suffix">%</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="productDescription">Description</label>
                            <textarea id="productDescription" class="textarea-field" name="description"></textarea>
                        </div>
                    </div>
                </div>

                <aside class="editor-side-col">
                    <div class="editor-panel panel">
                        <div class="editor-panel__title">Media</div>
                        <div class="form-group">
                            <label for="productImage">Product image</label>
                            <div class="upload-box">
                                <label class="upload-label" for="productImage">Select image</label>
                                <input id="productImage" class="upload-input" type="file" name="image" accept="image/*">
                            </div>
                            <img id="productImagePreview" class="product-preview" src="" alt="Product preview">
                        </div>
                        <div class="form-group">
                            <label class="input-field" for="removeImage">
                                <input id="removeImage" type="checkbox" name="remove_image" value="1">
                                Remove existing image
                            </label>
                        </div>
                    </div>

                    <div class="editor-panel panel">
                        <div class="editor-panel__title">Actions</div>
                        <div class="editor-actions">
                            <button type="button" class="btn btn-outline" id="editorCancelBtn">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Product</button>
                        </div>
                    </div>
                </aside>
            </div>
        </form>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin-products.js') }}"></script>
@endpush
