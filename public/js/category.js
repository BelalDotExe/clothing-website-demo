const menuToggle = document.getElementById("auraMenuToggle");
const nav = document.getElementById("auraNav");

if (menuToggle && nav) {
    menuToggle.addEventListener("click", () => {
        const isOpen = nav.classList.toggle("is-open");
        menuToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });
}

const store = window.auraProductStore;

if (!store) {
    throw new Error("Product store is required before category.js");
}

const PLACEHOLDER_IMAGE =
    "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 800'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop offset='0' stop-color='%23d8d8c7'/%3E%3Cstop offset='1' stop-color='%23f4f4e8'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='600' height='800' fill='url(%23g)'/%3E%3Cpath d='M162 560l92-118l80 104l40-54l104 128H122z' fill='%23c3c3b1'/%3E%3Ccircle cx='252' cy='296' r='54' fill='%23c9c9b8'/%3E%3C/svg%3E";

const elements = {
    tabs: document.querySelectorAll(".aura-pill[data-category]"),
    title: document.getElementById("categoryTitle"),
    breadcrumbLabel: document.getElementById("activeCategoryLabel"),
    count: document.getElementById("gridCount"),
    sort: document.getElementById("sortBy"),
    grid: document.getElementById("productGrid"),
    saleNavLink: document.getElementById("saleNavLink"),
};

const state = {
    activeCategory: "Women's Wear",
    sortBy: "newest",
};

function escapeHtml(value) {
    return String(value)
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#039;");
}

function formatPrice(product) {
    const hasDiscount = store.hasDiscount(product);

    if (!hasDiscount) {
        return `<p class="aura-card__price">${escapeHtml(store.formatCurrency(product.price))}</p>`;
    }

    const discounted = store.calculateDiscountedPrice(product);
    return `
        <div class="aura-price-row">
            <p class="aura-card__price aura-card__price--accent">${escapeHtml(store.formatCurrency(discounted))}</p>
            <p class="aura-strike">${escapeHtml(store.formatCurrency(product.price))}</p>
        </div>
    `;
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
    return image || PLACEHOLDER_IMAGE;
}

function productCard(product) {
    const hasDiscount = store.hasDiscount(product);
    const soldOut = Number(product.stock) <= 0;

    return `
        <article class="aura-card">
            <div class="aura-img">
                ${hasDiscount ? `<span class="aura-badge aura-badge--sale">-${escapeHtml(product.discountPercentage)}%</span>` : ""}
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
            <button class="aura-btn aura-btn--secondary" type="button" data-action="add-to-cart" ${soldOut ? "disabled" : ""}>
                ${soldOut ? "Out of Stock" : "Add to Cart"}
            </button>
        </article>
    `;
}

function getProductsForActiveTab() {
    const allProducts = store.getProducts();

    if (state.activeCategory === "Sale") {
        return allProducts.filter((product) => store.hasDiscount(product));
    }

    return allProducts.filter((product) => product.category === state.activeCategory);
}

function sortProducts(products) {
    const list = [...products];

    if (state.sortBy === "price-asc") {
        list.sort(
            (left, right) =>
                store.calculateDiscountedPrice(left) - store.calculateDiscountedPrice(right)
        );
    } else if (state.sortBy === "price-desc") {
        list.sort(
            (left, right) =>
                store.calculateDiscountedPrice(right) - store.calculateDiscountedPrice(left)
        );
    } else if (state.sortBy === "name-asc") {
        list.sort((left, right) => left.name.localeCompare(right.name));
    }

    return list;
}

function render() {
    const products = sortProducts(getProductsForActiveTab());
    elements.title.textContent = state.activeCategory;
    elements.breadcrumbLabel.textContent = state.activeCategory;
    elements.count.textContent = `Showing ${products.length} product${products.length === 1 ? "" : "s"}`;

    if (!products.length) {
        elements.grid.innerHTML = `
            <article class="aura-empty-state">
                <h2>No products yet</h2>
                <p>Products in this tab will appear here after they are added in Admin &gt; Products.</p>
            </article>
        `;
        return;
    }

    elements.grid.innerHTML = products.map(productCard).join("");
}

function setActiveTab(category) {
    state.activeCategory = category;
    elements.tabs.forEach((pill) => {
        const isSelected = pill.dataset.category === category;
        pill.classList.toggle("is-active", isSelected);
        pill.setAttribute("aria-selected", isSelected ? "true" : "false");
    });
    render();
}

elements.tabs.forEach((pill) => {
    pill.addEventListener("click", () => {
        const category = pill.dataset.category;
        if (!category) {
            return;
        }

        setActiveTab(category);
    });
});

elements.sort.addEventListener("change", (event) => {
    const target = event.target;
    if (!(target instanceof HTMLSelectElement)) {
        return;
    }

    state.sortBy = target.value;
    render();
});

elements.saleNavLink.addEventListener("click", (event) => {
    event.preventDefault();
    setActiveTab("Sale");
});

elements.grid.addEventListener("click", (event) => {
    const target = event.target;
    if (!(target instanceof Element)) {
        return;
    }

    const button = target.closest("button[data-action='add-to-cart']");
    if (!(button instanceof HTMLButtonElement)) {
        return;
    }

    const original = button.textContent;
    button.textContent = "Added";
    button.disabled = true;
    window.setTimeout(() => {
        button.textContent = original;
        if (original !== "Out of Stock") {
            button.disabled = false;
        }
    }, 1000);
});

window.addEventListener("aura:products-updated", () => {
    render();
});

if (window.location.hash.toLowerCase() === "#sale") {
    setActiveTab("Sale");
} else {
    setActiveTab(state.activeCategory);
}
