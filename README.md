# Clothing Website Demo

A Laravel-based e-commerce demo for a clothing store, featuring a public storefront with product browsing and checkout, plus a session-based admin panel for managing products, categories, orders, and notifications.

## Features

**Storefront**
- Homepage with trending products
- Women's wear category listing
- Shopping cart and checkout flow
- Stock-aware checkout: items are locked and validated against available inventory inside a database transaction, with out-of-stock items reported back to the user
- Order confirmation email dispatched asynchronously via a queued job after a successful checkout

**Admin Panel**
- Custom session-based admin authentication (separate from the default Laravel auth guard), with dedicated guest/auth middleware
- Dashboard showing total revenue, items sold, inventory levels, and category counts
- Product management (create, update, delete)
- Category management (create, delete)
- Internal notification log ("HB notifications") recording events such as new orders, with the ability to clear them

## Tech Stack

- **Backend:** Laravel 13 (PHP ^8.3)
- **Frontend tooling:** Vite, Tailwind CSS 4
- **Auth:** Laravel Sanctum (API tokens), custom guard for admin sessions
- **Testing:** PHPUnit, Mockery, Faker

## Requirements

- PHP >= 8.3
- Composer
- Node.js & npm
- A database supported by Laravel (SQLite is used by default for local development)

## Getting Started

Clone the repository and install dependencies:

```bash
git clone https://github.com/BilalDotExe/clothing-website-demo.git
cd clothing-website-demo
composer install
npm install
```

Set up your environment:

```bash
cp .env.example .env
php artisan key:generate
```

Configure your database connection in `.env`, then run migrations (and seeders, if available):

```bash
php artisan migrate
```

Build frontend assets:

```bash
npm run build
```

Or, for local development with hot reloading:

```bash
npm run dev
```

Alternatively, you can run the full setup in one step using the Composer script defined in this project:

```bash
composer run setup
```

## Running the App

Start the local development server:

```bash
php artisan serve
```

For a full local dev experience (server, queue worker, logs, and Vite all running together), use:

```bash
composer run dev
```

The app will be available at `http://localhost:8000`.

## Queue Worker

Order confirmation emails are sent through a queued job (`SendOrderConfirmationEmail`). Make sure a queue worker is running if you're not using the `composer run dev` script:

```bash
php artisan queue:listen
```

## Admin Access

The admin panel is available at `/admin/login`. Authentication is handled by a custom guard, so admin users are managed separately from regular application users — set up an admin user via your database seeder or directly in the `users` table before logging in.

## Testing

Run the test suite with:

```bash
composer run test
```

## Project Structure

```
app/
├── Http/Controllers/    # Storefront and admin controllers
├── Http/Middleware/     # Admin auth/guest middleware
├── Jobs/                # Queued jobs (e.g. order confirmation email)
├── Models/               # Product, Category, Order, HbNotif, User
database/
├── migrations/          # Schema for products, categories, orders, notifications
resources/views/
├── admin/               # Admin dashboard, login, products, categories
├── categories/          # Women's wear listing and cart
└── welcome.blade.php    # Homepage
routes/
├── web.php              # Storefront and admin routes
└── api.php
```

## License

This project is built on the Laravel framework, which is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
