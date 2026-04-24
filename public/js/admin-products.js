const sidebar = document.getElementById("dashboardSidebar");
const toggleButton = document.getElementById("sidebarToggle");

if (sidebar && toggleButton) {
    toggleButton.addEventListener("click", () => {
        sidebar.classList.toggle("is-open");
    });

    document.addEventListener("click", (event) => {
        const target = event.target;
        if (!(target instanceof Element)) {
            return;
        }

        const clickedInsideSidebar = sidebar.contains(target);
        const clickedToggle = toggleButton.contains(target);
        if (!clickedInsideSidebar && !clickedToggle) {
            sidebar.classList.remove("is-open");
        }
    });
}

const store = window.auraProductStore;

if (!store) {
    throw new Error("Product store is required before admin-products.js");
}

const PLACEHOLDER_IMAGE =
    "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 600'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop offset='0' stop-color='%23d8d8c7'/%3E%3Cstop offset='1' stop-color='%23f4f4e8'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='600' height='600' fill='url(%23g)'/%3E%3Cpath d='M200 370l70-90l55 70l35-45l95 115H145z' fill='%23c3c3b1'/%3E%3Ccircle cx='248' cy='212' r='42' fill='%23c9c9b8'/%3E%3C/svg%3E";

const elements = {
    listView: document.getElementById("productListView"),
    editorView: document.getElementById("productEditorView"),
    addButton: document.getElementById("openAddProductBtn"),
    editorBackButton: document.getElementById("editorBackBtn"),
    editorCancelButton: document.getElementById("editorCancelBtn"),
    editorTitle: document.getElementById("editorTitle"),
    editorSubtitle: document.getElementById("editorSubtitle"),
    editorSaveButton: document.getElementById("editorSaveBtn"),
    tableBody: document.getElementById("productTableBody"),
    inventorySummary: document.getElementById("inventorySummary"),
    paginationSummary: document.getElementById("paginationSummary"),
    categoryFilter: document.getElementById("categoryFilter"),
    stockFilter: document.getElementById("stockFilter"),
    searchInput: document.getElementById("productSearch"),
    form: document.getElementById("productEditorForm"),
    fields: {
        id: document.getElementById("productId"),
        name: document.getElementById("productName"),
        description: document.getElementById("productDescription"),
        price: document.getElementById("productPrice"),
        stock: document.getElementById("productStock"),
        sku: document.getElementById("productSku"),
        discount: document.getElementById("productDiscount"),
        image: document.getElementById("productImage"),
        category: document.getElementById("productCategory"),
        status: document.getElementById("productStatus"),
    },
    imagePreview: document.getElementById("productImagePreview"),
};

const state = {
    mode: "list",
    editingId: null,
    filters: {
        category: "all",
        stock: "all",
        query: "",
    },
};

function escapeHtml(value) {
    return String(value)
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#039;");
}

function getDisplayImage(imageUrl) {
    const trimmed = typeof imageUrl === "string" ? imageUrl.trim() : "";
    return trimmed || PLACEHOLDER_IMAGE;
}

function formatDiscountBadge(product) {
    if (!store.hasDiscount(product)) {
        return "";
    }

    return `<span class="badge badge-sale">-${escapeHtml(product.discountPercentage)}%</span>`;
}

function stockStatus(product) {
    const stock = Number(product.stock) || 0;

    if (stock <= 0) {
        return {
            label: "Out of Stock",
            className: "badge-destructive",
        };
    }

    if (stock <= 5) {
        return {
            label: `Low Stock (${stock})`,
            className: "badge-warning",
        };
    }

    return {
        label: `In Stock (${stock})`,
        className: "badge-success",
    };
}

function formatPrice(product) {
    if (!store.hasDiscount(product)) {
        return `<strong class="cell-price">${escapeHtml(store.formatCurrency(product.price))}</strong>`;
    }

    const discounted = store.calculateDiscountedPrice(product);
    return `
        <span class="price-stack">
            <strong class="cell-price">${escapeHtml(store.formatCurrency(discounted))}</strong>
            <span class="price-original">${escapeHtml(store.formatCurrency(product.price))}</span>
        </span>
    `;
}

function rowTemplate(product) {
    const status = stockStatus(product);

    return `
        <tr>
            <td>
                <div class="product-cell">
                    <img class="product-img" src="${escapeHtml(getDisplayImage(product.image))}" alt="">
                    <span class="product-info">
                        <span class="product-name-row">
                            <strong class="product-name">${escapeHtml(product.name)}</strong>
                            ${formatDiscountBadge(product)}
                        </span>
                        <small class="product-sku">SKU: ${escapeHtml(product.sku)}</small>
                    </span>
                </div>
            </td>
            <td><span class="cell-meta">${escapeHtml(product.category)}</span></td>
            <td>${formatPrice(product)}</td>
            <td><span class="badge ${escapeHtml(status.className)}">${escapeHtml(status.label)}</span></td>
            <td class="actions-td">
                <div class="action-wrap">
                    <button class="btn-icon" type="button" aria-label="Edit item" data-action="edit" data-id="${escapeHtml(product.id)}">
                        <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M3 17.25V21h3.75l11-11.03l-3.75-3.75zM20.7 7.04a1 1 0 0 0 0-1.41L18.37 3.3a1 1 0 0 0-1.41 0l-1.83 1.83l3.75 3.75z"/></svg>
                    </button>
                    <button class="btn-icon btn-icon-danger" type="button" aria-label="Delete item" data-action="delete" data-id="${escapeHtml(product.id)}">
                        <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M6 7h12l-1 14H7zm3-3h6l1 2H8z"/></svg>
                    </button>
                </div>
            </td>
        </tr>
    `;
}

function getFilteredProducts() {
    const products = store.getProducts();
    const query = state.filters.query.trim().toLowerCase();

    return products.filter((product) => {
        if (
            state.filters.category !== "all" &&
            product.category !== state.filters.category
        ) {
            return false;
        }

        if (state.filters.stock === "in-stock" && Number(product.stock) <= 5) {
            return false;
        }

        if (
            state.filters.stock === "low-stock" &&
            !(Number(product.stock) > 0 && Number(product.stock) <= 5)
        ) {
            return false;
        }

        if (state.filters.stock === "out-of-stock" && Number(product.stock) > 0) {
            return false;
        }

        if (!query) {
            return true;
        }

        const searchValue = `${product.name} ${product.sku} ${product.category}`.toLowerCase();
        return searchValue.includes(query);
    });
}

function renderSummary(filteredCount) {
    const totalProducts = store.getProducts().length;

    elements.inventorySummary.innerHTML = `Manage all <strong>${escapeHtml(totalProducts)}</strong> products in your catalog.`;

    if (filteredCount === 0) {
        elements.paginationSummary.innerHTML = "Showing <strong>0</strong> entries";
        return;
    }

    elements.paginationSummary.innerHTML = `Showing <strong>1</strong> to <strong>${escapeHtml(filteredCount)}</strong> of <strong>${escapeHtml(filteredCount)}</strong> entries`;
}

function renderTable() {
    const filteredProducts = getFilteredProducts();
    renderSummary(filteredProducts.length);

    if (!filteredProducts.length) {
        elements.tableBody.innerHTML = `
            <tr>
                <td colspan="5" class="empty-row">No products matched your filters.</td>
            </tr>
        `;
        return;
    }

    elements.tableBody.innerHTML = filteredProducts.map(rowTemplate).join("");
}

function fillCategoryOptions() {
    const categoryOptions = store.CATEGORIES.map(
        (category) =>
            `<option value="${escapeHtml(category)}">${escapeHtml(category)}</option>`
    ).join("");

    elements.fields.category.innerHTML = categoryOptions;

    const filterOptions = store.CATEGORIES.map(
        (category) =>
            `<option value="${escapeHtml(category)}">${escapeHtml(category)}</option>`
    ).join("");

    elements.categoryFilter.insertAdjacentHTML("beforeend", filterOptions);
}

function updateImagePreview(url) {
    elements.imagePreview.src = getDisplayImage(url);
}

function getEditorModeTitle(mode) {
    return mode === "edit" ? "Edit Product" : "Add New Product";
}

function openEditor(mode, product) {
    state.mode = mode;
    state.editingId = mode === "edit" ? product.id : null;

    elements.listView.classList.add("is-hidden");
    elements.editorView.classList.remove("is-hidden");
    elements.editorTitle.textContent = getEditorModeTitle(mode);
    elements.editorSaveButton.textContent =
        mode === "edit" ? "Save Changes" : "Save Product";

    if (mode === "edit") {
        elements.editorSubtitle.textContent = `Update details for ${product.name}`;
    } else {
        elements.editorSubtitle.textContent =
            "Create a new product item in your catalog.";
    }

    const draft = mode === "edit" ? product : store.createEmptyProduct();

    elements.fields.id.value = draft.id;
    elements.fields.name.value = draft.name || "";
    elements.fields.description.value = draft.description || "";
    elements.fields.price.value = Number(draft.price || 0).toFixed(2);
    elements.fields.stock.value = String(draft.stock || 0);
    elements.fields.sku.value = draft.sku || "";
    elements.fields.discount.value = String(draft.discountPercentage || 0);
    elements.fields.category.value = draft.category || "Women's Wear";
    elements.fields.status.value = draft.status || "Active (In Stock)";
    elements.fields.image.value = draft.image || "";
    updateImagePreview(draft.image || "");
}

function closeEditor() {
    state.mode = "list";
    state.editingId = null;
    elements.form.reset();
    elements.listView.classList.remove("is-hidden");
    elements.editorView.classList.add("is-hidden");
}

function buildProductFromForm() {
    return {
        id: elements.fields.id.value.trim() || store.createEmptyProduct().id,
        name: elements.fields.name.value.trim(),
        description: elements.fields.description.value.trim(),
        price: Number(elements.fields.price.value),
        stock: Number(elements.fields.stock.value),
        sku: elements.fields.sku.value.trim(),
        category: elements.fields.category.value,
        status: elements.fields.status.value,
        image: elements.fields.image.value.trim(),
        discountPercentage: Number(elements.fields.discount.value),
    };
}

function deleteProduct(productId) {
    const product = store.getProductById(productId);
    if (!product) {
        return;
    }

    const shouldDelete = window.confirm(
        `Delete "${product.name}" from your catalog?`
    );

    if (!shouldDelete) {
        return;
    }

    store.deleteProduct(productId);
    renderTable();
}

function startEdit(productId) {
    const product = store.getProductById(productId);
    if (!product) {
        return;
    }

    openEditor("edit", product);
}

function attachEvents() {
    elements.addButton.addEventListener("click", () => {
        openEditor("add", store.createEmptyProduct());
    });

    elements.editorBackButton.addEventListener("click", closeEditor);
    elements.editorCancelButton.addEventListener("click", closeEditor);

    elements.fields.image.addEventListener("input", (event) => {
        const target = event.target;
        if (!(target instanceof HTMLInputElement)) {
            return;
        }

        updateImagePreview(target.value);
    });

    elements.searchInput.addEventListener("input", (event) => {
        const target = event.target;
        if (!(target instanceof HTMLInputElement)) {
            return;
        }

        state.filters.query = target.value;
        renderTable();
    });

    elements.categoryFilter.addEventListener("change", (event) => {
        const target = event.target;
        if (!(target instanceof HTMLSelectElement)) {
            return;
        }

        state.filters.category = target.value;
        renderTable();
    });

    elements.stockFilter.addEventListener("change", (event) => {
        const target = event.target;
        if (!(target instanceof HTMLSelectElement)) {
            return;
        }

        state.filters.stock = target.value;
        renderTable();
    });

    elements.tableBody.addEventListener("click", (event) => {
        const target = event.target;
        if (!(target instanceof Element)) {
            return;
        }

        const button = target.closest("button[data-action]");
        if (!(button instanceof HTMLButtonElement)) {
            return;
        }

        const action = button.dataset.action;
        const productId = button.dataset.id;

        if (!productId) {
            return;
        }

        if (action === "edit") {
            startEdit(productId);
        }

        if (action === "delete") {
            deleteProduct(productId);
        }
    });

    elements.form.addEventListener("submit", (event) => {
        event.preventDefault();

        if (!elements.form.checkValidity()) {
            elements.form.reportValidity();
            return;
        }

        const product = buildProductFromForm();
        store.upsertProduct(product);
        closeEditor();
        renderTable();
    });

    window.addEventListener("aura:products-updated", () => {
        renderTable();
    });
}

fillCategoryOptions();
attachEvents();
renderTable();
