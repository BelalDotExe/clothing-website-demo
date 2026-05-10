const menuToggle = document.getElementById("hbMenuToggle");
const nav = document.getElementById("hbNav");

if (menuToggle && nav) {
    menuToggle.addEventListener("click", () => {
        const isOpen = nav.classList.toggle("is-open");
        menuToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });
}

const dbProducts = Array.isArray(window.hbProducts) ? window.hbProducts : [];
const cartKey = "hb_cart";

const PLACEHOLDER_IMAGE =
    "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 800'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop offset='0' stop-color='%23d8d8c7'/%3E%3Cstop offset='1' stop-color='%23f4f4e8'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='600' height='800' fill='url(%23g)'/%3E%3Cpath d='M162 560l92-118l80 104l40-54l104 128H122z' fill='%23c3c3b1'/%3E%3Ccircle cx='252' cy='296' r='54' fill='%23c9c9b8'/%3E%3C/svg%3E";

const el = {
    tabs: document.querySelectorAll(".aura-pill[data-category]"),
    title: document.getElementById("categoryTitle"),
    breadcrumbLabel: document.getElementById("activeCategoryLabel"),
    count: document.getElementById("gridCount"),
    sort: document.getElementById("sortBy"),
    grid: document.getElementById("productGrid"),
    cartCount: document.getElementById("hbCartCount"),
    navCategories: document.querySelector(".aura-nav__link[data-nav-tab='categories']"),
    navSale: document.querySelector(".aura-nav__link[data-nav-tab='sale']"),
};

const st = {
    activeCategory: typeof window.hbDefaultCategory === "string" && window.hbDefaultCategory.trim()
        ? window.hbDefaultCategory.trim()
        : "Sale",
    sortBy: "newest",
};

function getCart() {
    try {
        const raw = localStorage.getItem(cartKey);
        const list = raw ? JSON.parse(raw) : [];
        return Array.isArray(list) ? list : [];
    } catch {
        return [];
    }
}

function setCart(list) {
    localStorage.setItem(cartKey, JSON.stringify(list));
}

function updateCartCount() {
    if (!el.cartCount) {
        return;
    }

    const c = getCart().reduce((n, i) => n + (Number(i.qty) || 0), 0);
    el.cartCount.textContent = String(c);
    el.cartCount.style.display = c > 0 ? "inline-flex" : "none";
}

function addToCart(p) {
    const list = getCart();
    const id = Number(p.id) || 0;
    const stock = Math.max(0, Number(p.stock) || 0);

    if (stock <= 0) {
        return;
    }

    const i = list.findIndex((x) => Number(x.id) === id);

    if (i >= 0) {
        const nextQty = (Number(list[i].qty) || 0) + 1;
        list[i].qty = Math.min(nextQty, stock);
        list[i].stock = stock;
    } else {
        list.push({
            id,
            name: p.name,
            price: Number(p.price) || 0,
            image: getImageUrl(p),
            category: p.category || "",
            stock,
            qty: 1,
        });
    }

    setCart(list);
    updateCartCount();
}

function escapeHtml(value) {
    return String(value)
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#039;");
}

//price currency formatter
function formatPrice(product) {
    const fmt = new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" });
    return `<p class="aura-card__price">${escapeHtml(fmt.format(Number(product.price) || 0))}</p>`;
}

function stockMeta(product) {
    const stock = Number(product.stock) || 0;

    if (stock <= 0) {
        return "Out of Stock";
    }

    if (stock <= 5) {
        return `Low Stock (${stock})`;
    }

    return "In Stock";
}

function getImageUrl(product) {
    const image = typeof product.image === "string" ? product.image.trim() : "";
    if (!image) {
        return PLACEHOLDER_IMAGE;
    }

    if (image.startsWith("http://") || image.startsWith("https://") || image.startsWith("data:") || image.startsWith("/storage/")) {
        return image;
    }

    return `/storage/${image}`;
}

function productCard(product) {
    const hasDiscount = Boolean(product.on_sale) || Number(product.discount) >= 1;
    const soldOut = Number(product.stock) <= 0;
    const lowStock = Number(product.stock) > 0 && Number(product.stock) <= 5;

    return `
        <article class="aura-card">
            <div class="aura-img">
                ${hasDiscount ? `<span class="aura-badge aura-badge--sale">Sale</span>` : ""}
                ${lowStock ? `<span class="aura-badge aura-badge--low">Low Stock</span>` : ""}
                <img class="aura-img__media" src="${escapeHtml(getImageUrl(product))}" alt="${escapeHtml(product.name)}">
            </div>
            <div class="aura-card__body">
                <div>
                    <h2 class="aura-card__title">${escapeHtml(product.name)}</h2>
                    <p class="aura-card__meta">${escapeHtml(product.category)}</p>
                    <p class="aura-card__stock">${escapeHtml(stockMeta(product))}</p>
                </div>
                ${formatPrice(product)}
            </div>
            <button class="aura-btn aura-btn--secondary" type="button" data-action="add-to-cart" data-id="${escapeHtml(product.id)}" ${soldOut ? "disabled" : ""}>
                ${soldOut ? "Out of Stock" : "Add to Cart"}
            </button>
        </article>
    `;
}

function getProductsForActiveTab() {
    if (st.activeCategory === "Sale") {
        return dbProducts.filter((product) => Boolean(product.on_sale));
    }

    const normalizeCategory = (value) =>
        String(value || "")
            .toLowerCase()
            .replace(/[^a-z0-9]/g, "");

    const activeCategory = normalizeCategory(st.activeCategory);

    return dbProducts.filter(
        (product) => normalizeCategory(product.category) === activeCategory
    );
}

function sortProducts(products) {
    const list = [...products];

    if (st.sortBy === "price-asc") {
        list.sort((left, right) => Number(left.price || 0) - Number(right.price || 0));
    } else if (st.sortBy === "price-desc") {
        list.sort((left, right) => Number(right.price || 0) - Number(left.price || 0));
    } else if (st.sortBy === "name-asc") {
        list.sort((left, right) => left.name.localeCompare(right.name));
    } else {
        list.sort((left, right) => Number(right.id || 0) - Number(left.id || 0));
    }

    return list;
}

function render() {
    const products = sortProducts(getProductsForActiveTab());
    el.title.textContent = st.activeCategory;
    el.breadcrumbLabel.textContent = st.activeCategory;
    el.count.textContent = `Showing ${products.length} product${products.length === 1 ? "" : "s"}`;

    if (!products.length) {
        el.grid.innerHTML = `
            <article class="aura-empty-state">
                <h2>No products yet</h2>
                <p>Products in this tab will appear here after they are added in Admin &gt; Products.</p>
            </article>
        `;
        return;
    }

    el.grid.innerHTML = products.map(productCard).join("");
}

function setActiveTab(category) {
    st.activeCategory = category;
    el.tabs.forEach((pill) => {
        const isSelected = pill.dataset.category === category;
        pill.classList.toggle("is-active", isSelected);
        pill.setAttribute("aria-selected", isSelected ? "true" : "false");
    });
    const isSale = category === "Sale";
    if (el.navSale) {
        el.navSale.classList.toggle("aura-nav__link--active", isSale);
    }
    if (el.navCategories) {
        el.navCategories.classList.toggle("aura-nav__link--active", !isSale);
    }
    render();
}

el.tabs.forEach((pill) => {
    pill.addEventListener("click", () => {
        const category = pill.dataset.category;
        if (!category) {
            return;
        }

        setActiveTab(category);
    });
});

if (el.sort) {
    el.sort.addEventListener("change", (event) => {
        const target = event.target;
        if (!(target instanceof HTMLSelectElement)) {
            return;
        }

        st.sortBy = target.value;
        render();
    });
}

el.grid.addEventListener("click", (event) => {
    const target = event.target;
    if (!(target instanceof Element)) {
        return;
    }

    const btn = target.closest("button[data-action='add-to-cart']");
    if (!(btn instanceof HTMLButtonElement)) {
        return;
    }

    const id = Number(btn.dataset.id || 0);
    const p = dbProducts.find((item) => Number(item.id) === id);
    if (!p) {
        return;
    }

    addToCart(p);

    const old = btn.textContent;
    btn.textContent = "Added";
    btn.disabled = true;
    window.setTimeout(() => {
        btn.textContent = old;
        if (old !== "Out of Stock") {
            btn.disabled = false;
        }
    }, 700);
});

function normalizeCategory(value) {
    return String(value || "")
        .toLowerCase()
        .replace(/[^a-z0-9]/g, "");
}

function syncFromHash() {
    const hashCategory = window.location.hash.replace(/^#/, "").trim();
    if (!hashCategory) {
        setActiveTab(st.activeCategory);
        return;
    }

    const wanted = normalizeCategory(decodeURIComponent(hashCategory));
    const tabMatch = Array.from(el.tabs).find(
        (pill) => normalizeCategory(pill.dataset.category) === wanted
    );

    if (tabMatch?.dataset.category) {
        setActiveTab(tabMatch.dataset.category);
    } else if (wanted === "sale") {
        setActiveTab("Sale");
    } else {
        setActiveTab(st.activeCategory);
    }
}

window.addEventListener("hashchange", syncFromHash);
syncFromHash();

updateCartCount();
