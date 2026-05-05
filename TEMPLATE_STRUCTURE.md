# Clothing Store - Template Structure Guide

## Project Organization Overview

This Laravel project uses a clean, organized template system with proper separation of concerns. Here's how the project is structured:

---

## 📁 Directory Structure

```
resources/
├── views/
│   ├── layouts/
│   │   ├── customer.blade.php    # Main layout for customer-facing pages
│   │   └── admin.blade.php       # Main layout for admin dashboard
│   ├── components/
│   │   ├── customer/
│   │   │   ├── header.blade.php  # Customer site header with navigation
│   │   │   └── footer.blade.php  # Customer site footer
│   │   └── admin/
│   │       ├── sidebar.blade.php # Admin sidebar navigation
│   │       └── topbar.blade.php  # Admin top bar with search & user menu
│   ├── pages/                    # Customer-facing pages
│   │   ├── home.blade.php        # Homepage
│   │   ├── categories/
│   │   │   └── show.blade.php    # Category/products listing page
│   │   └── cart.blade.php        # Shopping cart page
│   ├── auth/
│   │   └── login.blade.php       # Admin login page
│   └── admin/
│       ├── dashboard.blade.php   # Admin dashboard
│       └── products/
│           └── index.blade.php   # Products management page

public/
├── css/
│   ├── landing.css              # Homepage styles
│   ├── category.css             # Category page styles
│   ├── cart.css                 # Cart page styles
│   ├── admin-login.css          # Admin login styles
│   ├── admin-dashboard.css      # Admin dashboard styles
│   └── admin-products.css       # Admin products management styles
├── js/
│   ├── landing.js               # Homepage scripts
│   ├── category.js              # Category page scripts
│   ├── cart.js                  # Cart functionality
│   ├── admin-login.js           # Admin login scripts
│   ├── admin-dashboard.js       # Admin dashboard scripts
│   └── admin-products.js        # Admin products management scripts
```

---

## 🎨 Template Hierarchy

### Customer Site Layout
**File**: `resources/views/layouts/customer.blade.php`

Base layout for all customer-facing pages. Includes:
- Master HTML structure
- Font imports and base styles
- `@include('components.customer.header')`
- `@yield('content')` - Page-specific content
- `@include('components.customer.footer')`
- `@stack('styles')` and `@stack('scripts')` - Per-page CSS/JS

**Usage**:
```blade
@extends('layouts.customer')
@section('title', 'Page Title')
@section('content')
    <!-- Page content here -->
@endsection
```

---

### Admin Layout
**File**: `resources/views/layouts/admin.blade.php`

Base layout for all admin pages. Includes:
- Master HTML structure
- Admin-specific styles
- `@include('components.admin.sidebar')`
- `@include('components.admin.topbar')`
- `@yield('content')` - Page-specific content
- `@stack('styles')` and `@stack('scripts')` - Per-page CSS/JS

**Usage**:
```blade
@extends('layouts.admin')
@section('title', 'Page Title')
@section('page_title', 'Display Title')
@section('content')
    <!-- Page content here -->
@endsection
```

---

## 🔧 Components

### Customer Components

#### Header (`components/customer/header.blade.php`)
- Branding and logo
- Navigation menu (Home, Categories, New Arrivals)
- Search button
- Admin login link
- Shopping cart icon with item count

#### Footer (`components/customer/footer.blade.php`)
- About section
- Quick links
- Support links
- Social media links
- Copyright information

### Admin Components

#### Sidebar (`components/admin/sidebar.blade.php`)
- Brand logo and name
- Main navigation (Dashboard, Products, Categories, Orders, Customers)
- System menu (Settings)
- Logout button
- Active page highlighting using `Request::path()`

#### Topbar (`components/admin/topbar.blade.php`)
- Sidebar toggle button
- Page title display
- Search bar
- Notifications button
- User avatar and menu button

---

## 📄 Pages

### Customer Pages

#### Home (`pages/home.blade.php`)
- Extends: `layouts.customer`
- Hero section with call-to-action
- Featured collection section
- Includes landing.js and landing.css

#### Categories (`pages/categories/show.blade.php`)
- Extends: `layouts.customer`
- Breadcrumb navigation
- Category filter tabs (Women's, Men's, Shoes, Accessories, Sale)
- Product grid with sorting options
- Includes category.js and category.css

#### Cart (`pages/cart.blade.php`)
- Extends: `layouts.customer`
- Cart items display
- Order summary sidebar
- Checkout button
- Includes cart.js and cart.css

### Admin Pages

#### Login (`auth/login.blade.php`)
- Standalone page (NOT using admin layout)
- Split design (visual + form)
- Username/password form
- Error message display
- Password visibility toggle

#### Dashboard (`admin/dashboard.blade.php`)
- Extends: `layouts.admin`
- Key metrics cards (Sales, Orders, Inventory)
- Low stock items table
- Catalog management panel
- Includes admin-dashboard.js and admin-dashboard.css

#### Products Management (`admin/products/index.blade.php`)
- Extends: `layouts.admin`
- Search and filter inputs
- Products table with management actions
- Add product modal
- Form for creating/editing products
- Includes admin-products.js and admin-products.css

---

## 🛣️ Routes

All routes are organized in `routes/web.php` with clear sections:

### Public Routes
- `GET /` - Homepage (returns `pages.home`)
- `GET /categories/womens-wear` - Category page
- `GET /cart` - Shopping cart

### Admin Routes (Guest Only)
- `GET /admin/login` - Admin login form
- `POST /admin/login` - Login submission

### Admin Routes (Authenticated)
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/products` - Products management
- `POST /admin/products` - Create product
- `PUT /admin/products/{product}` - Update product
- `DELETE /admin/products/{product}` - Delete product
- `POST /admin/logout` - Logout

---

## 🎯 Best Practices

1. **Always extend a layout**: Use `@extends()` with either `layouts.customer` or `layouts.admin`
2. **Use sections for content**: Define content in `@section('content')...@endsection`
3. **Per-page styles/scripts**: Use `@push('styles')` and `@push('scripts')` for page-specific assets
4. **Reuse components**: Import shared UI elements using `@include()`
5. **Set page titles**: Use `@section('title', 'Page Title')` for SEO and browser title
6. **Keep components simple**: Each component should have a single responsibility
7. **Active state tracking**: Use `Request::path()` to highlight active navigation items

---

## 📋 CSS/JS Organization

### CSS Files
- One CSS file per feature/page
- Responsive design included
- Consistent naming conventions

### JavaScript Files
- One JS file per feature/page
- Event delegation for dynamic content
- Proper initialization on page load

### Asset Linking
```blade
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('css/filename.css') }}">

<!-- JS -->
<script src="{{ asset('js/filename.js') }}"></script>
```

---

## 🔄 How to Add a New Page

1. **Create the blade file** in `resources/views/pages/` or `resources/views/admin/`
2. **Extend the layout**:
   ```blade
   @extends('layouts.customer')  // or 'layouts.admin'
   @section('title', 'Your Page Title')
   ```
3. **Add content** in `@section('content')`
4. **Create controller method** in appropriate controller
5. **Add route** in `routes/web.php`
6. **Add CSS/JS** in `public/css/` and `public/js/` as needed
7. **Link assets** using `@push('styles')` and `@push('scripts')`

---

## 🔐 Security Notes

- Admin routes use `adm.auth` middleware for authentication
- Guest routes use `adm.guest` middleware
- CSRF tokens required on all POST/PUT/DELETE requests (`@csrf`)
- Input validation in controllers
- Password fields hidden by default with toggle option

---

## 🚀 Getting Started

1. The template system is now properly organized
2. All old files have been migrated to the new structure
3. Routes have been updated to point to new view paths
4. Controllers have been updated to return new views
5. No functionality has been changed - only organization improved

Simply start the development server and the site will work as expected with the new clean template structure!
