(function () {
    const STORAGE_KEY = "aura.products.v1";
    const CATEGORIES = ["Women's Wear", "Men's Wear", "Shoes", "Accessories"];

    const DEFAULT_PRODUCTS = [
        {
            id: "au-1045",
            name: "Linen Button-Down Shirt",
            description:
                "A classic linen button-down shirt perfect for summer. Features a relaxed fit and breathable fabric.",
            price: 54.99,
            stock: 145,
            sku: "AU-1045",
            category: "Men's Wear",
            status: "Active (In Stock)",
            image: "https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?auto=format&fit=crop&w=700&q=80",
            discountPercentage: 0,
        },
        {
            id: "au-1092",
            name: "Olive Green Chinos",
            description:
                "Tapered chinos crafted in stretch cotton for a clean, all-day look.",
            price: 68,
            stock: 2,
            sku: "AU-1092",
            category: "Men's Wear",
            status: "Active (Low Stock)",
            image: "https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?auto=format&fit=crop&w=700&q=80",
            discountPercentage: 10,
        },
        {
            id: "au-2104",
            name: "Floral Wrap Midi Dress",
            description:
                "Lightweight wrap midi dress with soft floral print and fluid drape.",
            price: 89.5,
            stock: 42,
            sku: "AU-2104",
            category: "Women's Wear",
            status: "Active (In Stock)",
            image: "https://images.unsplash.com/photo-1591369822096-ffd140ec948f?auto=format&fit=crop&w=700&q=80",
            discountPercentage: 20,
        },
        {
            id: "au-2841",
            name: "Oversized Knit Sweater",
            description:
                "Chunky oversized knit sweater designed for layering in cooler weather.",
            price: 75,
            stock: 5,
            sku: "AU-2841",
            category: "Women's Wear",
            status: "Active (Low Stock)",
            image: "https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=700&q=80",
            discountPercentage: 0,
        },
        {
            id: "au-4019",
            name: "Leather Crossbody Bag",
            description:
                "Compact genuine leather crossbody bag with adjustable strap and zip closure.",
            price: 120,
            stock: 1,
            sku: "AU-4019",
            category: "Accessories",
            status: "Active (Low Stock)",
            image: "https://images.unsplash.com/photo-1594223274512-ad4803739b7c?auto=format&fit=crop&w=700&q=80",
            discountPercentage: 15,
        },
        {
            id: "au-5103",
            name: "Classic Canvas Sneakers",
            description:
                "Minimal low-top canvas sneakers with cushioned insole for daily wear.",
            price: 60,
            stock: 4,
            sku: "AU-5103",
            category: "Shoes",
            status: "Active (Low Stock)",
            image: "https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=700&q=80",
            discountPercentage: 0,
        },
        {
            id: "au-4330",
            name: "Aviator Sunglasses",
            description:
                "Classic aviator frames with UV-protected lenses and lightweight metal temples.",
            price: 45,
            stock: 89,
            sku: "AU-4330",
            category: "Accessories",
            status: "Active (In Stock)",
            image: "https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=700&q=80",
            discountPercentage: 0,
        },
    ];

    function clamp(value, min, max) {
        return Math.min(Math.max(value, min), max);
    }

    function coerceNumber(value, fallback) {
        if (typeof value === "number" && Number.isFinite(value)) {
            return value;
        }

        if (typeof value === "string") {
            const trimmed = value.trim();
            if (!trimmed) {
                return fallback;
            }

            const parsed = Number(trimmed);
            return Number.isFinite(parsed) ? parsed : fallback;
        }

        return fallback;
    }

    function normalizeCategory(value) {
        return CATEGORIES.includes(value) ? value : "Women's Wear";
    }

    function normalizeStatus(value, stock) {
        if (value === "Inactive") {
            return "Inactive";
        }

        if (stock <= 0) {
            return "Out of Stock";
        }

        return stock <= 5 ? "Active (Low Stock)" : "Active (In Stock)";
    }

    function createId() {
        return `p-${Date.now()}-${Math.floor(Math.random() * 1000)}`;
    }

    function normalizeProduct(rawProduct) {
        const raw = rawProduct && typeof rawProduct === "object" ? rawProduct : {};
        const stock = Math.max(0, Math.round(coerceNumber(raw.stock, 0)));

        const normalized = {
            id: String(raw.id || createId()),
            name: String(raw.name || "").trim(),
            description: String(raw.description || "").trim(),
            price: clamp(coerceNumber(raw.price, 0), 0, 1000000),
            stock,
            sku: String(raw.sku || "").trim(),
            category: normalizeCategory(raw.category),
            status: normalizeStatus(raw.status, stock),
            image: String(raw.image || "").trim(),
            discountPercentage: clamp(
                Math.round(coerceNumber(raw.discountPercentage, 0)),
                0,
                100
            ),
        };

        if (!normalized.sku) {
            normalized.sku = `AU-${Math.floor(1000 + Math.random() * 9000)}`;
        }

        return normalized;
    }

    function parseStoredProducts() {
        try {
            const rawValue = window.localStorage.getItem(STORAGE_KEY);
            if (!rawValue) {
                return null;
            }

            const parsed = JSON.parse(rawValue);
            if (!Array.isArray(parsed)) {
                return null;
            }

            return parsed.map(normalizeProduct);
        } catch (error) {
            return null;
        }
    }

    function emitProductsUpdated(products) {
        window.dispatchEvent(
            new CustomEvent("aura:products-updated", {
                detail: { products },
            })
        );
    }

    function saveProducts(products) {
        const normalizedProducts = Array.isArray(products)
            ? products.map(normalizeProduct)
            : [];
        window.localStorage.setItem(STORAGE_KEY, JSON.stringify(normalizedProducts));
        emitProductsUpdated(normalizedProducts);
        return normalizedProducts;
    }

    function getProducts() {
        const storedProducts = parseStoredProducts();
        if (storedProducts) {
            return storedProducts;
        }

        const seededProducts = DEFAULT_PRODUCTS.map(normalizeProduct);
        saveProducts(seededProducts);
        return seededProducts;
    }

    function upsertProduct(inputProduct) {
        const product = normalizeProduct(inputProduct);
        const products = getProducts();
        const existingIndex = products.findIndex((item) => item.id === product.id);

        if (existingIndex >= 0) {
            products[existingIndex] = product;
        } else {
            products.unshift(product);
        }

        saveProducts(products);
        return product;
    }

    function deleteProduct(productId) {
        const products = getProducts();
        const nextProducts = products.filter((product) => product.id !== productId);
        saveProducts(nextProducts);
        return nextProducts;
    }

    function getProductById(productId) {
        const products = getProducts();
        return products.find((product) => product.id === productId) || null;
    }

    function hasDiscount(product) {
        return coerceNumber(product && product.discountPercentage, 0) > 0;
    }

    function calculateDiscountedPrice(product) {
        const price = coerceNumber(product && product.price, 0);
        const discount = clamp(coerceNumber(product && product.discountPercentage, 0), 0, 100);
        const discounted = price - price * (discount / 100);
        return Math.max(0, Number(discounted.toFixed(2)));
    }

    function formatCurrency(amount) {
        return new Intl.NumberFormat("en-US", {
            style: "currency",
            currency: "USD",
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        }).format(coerceNumber(amount, 0));
    }

    function createEmptyProduct() {
        return {
            id: createId(),
            name: "",
            description: "",
            price: 0,
            stock: 0,
            sku: "",
            category: "Women's Wear",
            status: "Active (In Stock)",
            image: "",
            discountPercentage: 0,
        };
    }

    window.auraProductStore = {
        CATEGORIES,
        STORAGE_KEY,
        getProducts,
        saveProducts,
        upsertProduct,
        deleteProduct,
        getProductById,
        hasDiscount,
        calculateDiscountedPrice,
        formatCurrency,
        createEmptyProduct,
    };
})();
