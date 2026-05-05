# 🎯 Quick Reference Card

## File Locations at a Glance

### 🏠 Customer Pages
```
pages/home.blade.php              → Route: /
pages/categories/show.blade.php   → Route: /categories/womens-wear
pages/cart.blade.php              → Route: /cart
```

### 👨‍💼 Admin Pages
```
auth/login.blade.php              → Route: /admin/login
admin/dashboard.blade.php         → Route: /admin/dashboard
admin/products/index.blade.php    → Route: /admin/products
```

### 🎨 Shared Components
```
components/customer/header.blade.php     → Navigation & branding
components/customer/footer.blade.php     → Footer links
components/admin/sidebar.blade.php       → Admin menu
components/admin/topbar.blade.php        → Admin search & user menu
```

### 📦 Master Layouts
```
layouts/customer.blade.php        → Base for all customer pages
layouts/admin.blade.php           → Base for all admin pages
```

### 🎨 Stylesheets
```
public/css/landing.css            → Homepage
public/css/category.css           → Category/products listing
public/css/cart.css               → Shopping cart
public/css/admin-login.css        → Admin login page
public/css/admin-dashboard.css    → Admin dashboard
public/css/admin-products.css     → Product management
```

### 📜 Scripts
```
public/js/landing.js              → Homepage functionality
public/js/category.js             → Category filtering & sorting
public/js/cart.js                 → Cart operations
public/js/admin-login.js          → Login interactions
public/js/admin-dashboard.js      → Dashboard interactions
public/js/admin-products.js       → Product CRUD operations
```

---

## 🔗 Template Usage Pattern

```blade
@extends('layouts.customer')        {{-- or layouts.admin --}}

@section('title', 'Page Title')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page.css') }}">
@endpush

@section('content')
    <h1>Your Content Here</h1>
@endsection

@push('scripts')
    <script src="{{ asset('js/page.js') }}"></script>
@endpush
```

---

## 🛣️ Route Quick Reference

| Method | Path | Controller | Function |
|--------|------|-----------|----------|
| GET | `/` | - | returns `pages.home` |
| GET | `/categories/womens-wear` | CategoryController | `womensWear()` |
| GET | `/cart` | CategoryController | `cart()` |
| GET | `/admin/login` | AdminAuthController | `show()` |
| POST | `/admin/login` | AdminAuthController | `login()` |
| GET | `/admin/dashboard` | - | returns `admin.dashboard` |
| GET | `/admin/products` | ProductController | `index()` |
| POST | `/admin/products` | ProductController | `store()` |
| PUT | `/admin/products/{id}` | ProductController | `update()` |
| DELETE | `/admin/products/{id}` | ProductController | `delete()` |
| POST | `/admin/logout` | AdminAuthController | `logout()` |

---

## 🎯 Common Tasks

### Add New Customer Page
```
1. Create: resources/views/pages/yourpage.blade.php
2. Add route to routes/web.php
3. Create CSS: public/css/yourpage.css (optional)
4. Create JS: public/js/yourpage.js (optional)
5. Use @extends('layouts.customer')
```

### Add New Admin Page
```
1. Create: resources/views/admin/yourpage.blade.php
2. Add route to routes/web.php with adm.auth middleware
3. Create CSS: public/css/admin-yourpage.css (optional)
4. Create JS: public/js/admin-yourpage.js (optional)
5. Use @extends('layouts.admin')
```

### Modify Shared Header
```
Edit: components/customer/header.blade.php
→ Changes appear on all customer pages
```

### Modify Admin Sidebar
```
Edit: components/admin/sidebar.blade.php
→ Changes appear on all admin pages
```

### Change Page Title
```blade
@section('title', 'New Title Here')
```

### Add Page-Specific Styles
```blade
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page.css') }}">
@endpush
```

### Add Page-Specific Scripts
```blade
@push('scripts')
    <script src="{{ asset('js/page.js') }}"></script>
@endpush
```

---

## 📂 View Includes (Use in Components)

```blade
<!-- Include customer header on any page -->
@include('components.customer.header')

<!-- Include customer footer on any page -->
@include('components.customer.footer')

<!-- Include admin sidebar on any page -->
@include('components.admin.sidebar')

<!-- Include admin topbar on any page -->
@include('components.admin.topbar')
```

---

## 🔐 Authentication Middleware

| Middleware | Usage | Routes |
|-----------|-------|--------|
| `adm.guest` | Only access if NOT logged in | `/admin/login` |
| `adm.auth` | Only access if logged in | `/admin/dashboard`, `/admin/products` |

---

## 📝 CSRF Protection

Always include on forms:
```blade
<form method="POST">
    @csrf
    <!-- form fields -->
</form>
```

---

## 🚨 Common Blade Directives in Templates

```blade
{{-- Output variable --}}
{{ $variable }}

{{-- Escape output --}}
{{ htmlspecialchars($variable) }}

{{-- Include component --}}
@include('components.name')

{{-- Include with data --}}
@include('components.name', ['key' => $value])

{{-- Check user is logged in --}}
@auth
@endauth

{{-- Check user is NOT logged in --}}
@guest
@endguest

{{-- Conditionals --}}
@if ($condition)
@elseif ($other)
@else
@endif

{{-- Loops --}}
@foreach ($items as $item)
@endforeach

{{-- Check if array is empty --}}
@forelse ($items as $item)
@empty
    No items found
@endforelse
```

---

## 📊 Project Statistics

- **Total Blade Templates**: 12
- **Master Layouts**: 2
- **Components**: 4
- **Customer Pages**: 3
- **Admin Pages**: 3
- **CSS Files**: 6
- **JavaScript Files**: 6
- **Documentation Files**: 4

---

## 💡 Pro Tips

1. **Don't edit routes in browser** - Use `routes/web.php`
2. **Don't duplicate components** - Use `@include()`
3. **Keep CSS scoped** - Use specific class names for each page
4. **Use meaningful names** - Route and file names should be descriptive
5. **Comment your code** - Future you will thank you
6. **Test changes locally** - Before pushing to production
7. **Use version control** - Track changes with Git

---

## 📞 Need Help?

Refer to these documentation files:
- **TEMPLATE_STRUCTURE.md** - Complete technical reference
- **ORGANIZATION_SUMMARY.md** - What was done & benefits
- **ARCHITECTURE_GUIDE.md** - Visual diagrams & relationships

---

**Last Updated**: April 30, 2026
**Project**: Clothing Store Website
**Framework**: Laravel 11+
**Status**: ✅ Properly Organized
