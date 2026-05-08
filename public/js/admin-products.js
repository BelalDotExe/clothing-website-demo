const sidebar = document.getElementById("dashboardSidebar");
const toggleButton = document.getElementById("sidebarToggle");
const listView = document.getElementById("productListView");
const editorView = document.getElementById("productEditorView");
const addButton = document.getElementById("openAddProductBtn");
const backButton = document.getElementById("editorBackBtn");
const cancelButton = document.getElementById("editorCancelBtn");
const form = document.getElementById("productEditorForm");
const productFormMethod = document.getElementById("productFormMethod");
const productStock = document.getElementById("productStock");
const productId = document.getElementById("productId");
const productName = document.getElementById("productName");
const productPrice = document.getElementById("productPrice");
const productDiscount = document.getElementById("productDiscount");
const productCategory = document.getElementById("productCategory");
const productSale = document.getElementById("productSale");
const productImage = document.getElementById("productImage");
const productImagePreview = document.getElementById("productImagePreview");
const removeImage = document.getElementById("removeImage");
const tableBody = document.getElementById("productTableBody");
const editorTitle = document.getElementById("editorTitle");
const editorSubtitle = document.getElementById("editorSubtitle");

const storeAction =
    form instanceof HTMLFormElement ? form.dataset.storeAction || form.action : "";
const updateActionTemplate =
    form instanceof HTMLFormElement ? form.dataset.updateActionTemplate || "" : "";

function setCreateMode() {
    if (!(form instanceof HTMLFormElement)) {
        return;
    }

    form.action = storeAction;

    if (productFormMethod instanceof HTMLInputElement) {
        productFormMethod.disabled = true;
    }

    if (editorTitle) {
        editorTitle.textContent = "Add New Product";
    }

    if (editorSubtitle) {
        editorSubtitle.textContent = "Create a new product item in your catalog.";
    }
}

function setEditMode(productData) {
    if (!(form instanceof HTMLFormElement)) {
        return;
    }

    const productKey = (productData.id || "").trim();
    if (!productKey || !updateActionTemplate) {
        return;
    }

    form.action = updateActionTemplate.replace(
        "PRODUCT-ID-TOKEN",
        encodeURIComponent(productKey)
    );

    if (productFormMethod instanceof HTMLInputElement) {
        productFormMethod.disabled = false;
        productFormMethod.value = "PUT";
    }

    if (editorTitle) {
        editorTitle.textContent = "Edit Product";
    }

    if (editorSubtitle) {
        editorSubtitle.textContent = `Update details for ${productData.name || "this product"}`;
    }
}

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

function openEditor() {
    if (!listView || !editorView || !form) {
        return;
    }

    form.reset();
    setCreateMode();
    if (productId instanceof HTMLInputElement) {
        productId.value = "";
    }
    if (productImagePreview instanceof HTMLImageElement) {
        productImagePreview.src = "";
    }
    if (removeImage instanceof HTMLInputElement) {
        removeImage.checked = false;
    }
    listView.classList.add("is-hidden");
    editorView.classList.remove("is-hidden");
}

function closeEditor() {
    if (!listView || !editorView) {
        return;
    }

    listView.classList.remove("is-hidden");
    editorView.classList.add("is-hidden");
}

if (addButton) {
    addButton.addEventListener("click", openEditor);
}

if (backButton) {
    backButton.addEventListener("click", closeEditor);
}

if (cancelButton) {
    cancelButton.addEventListener("click", closeEditor);
}

if (form) {
    form.addEventListener("submit", (event) => {
        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            return;
        }

        if (productStock instanceof HTMLInputElement) {
            const stockValue = Number(productStock.value || 0);
            const existingInStockInput = form.querySelector("input[name='in_stock']");
            if (existingInStockInput) {
                existingInStockInput.remove();
            }
            const inStockInput = document.createElement("input");
            inStockInput.type = "hidden";
            inStockInput.name = "in_stock";
            inStockInput.value = stockValue > 0 ? "1" : "0";
            form.appendChild(inStockInput);
        }
    });
}

if (productImage instanceof HTMLInputElement && productImagePreview instanceof HTMLImageElement) {
    productImage.addEventListener("change", (event) => {
        const target = event.target;
        if (!(target instanceof HTMLInputElement) || !target.files || target.files.length === 0) {
            return;
        }

        const file = target.files[0];
        const reader = new FileReader();
        reader.onload = () => {
            if (typeof reader.result === "string") {
                productImagePreview.src = reader.result;
            }
        };
        reader.readAsDataURL(file);

        if (removeImage instanceof HTMLInputElement) {
            removeImage.checked = false;
        }
    });
}

if (tableBody) {
    tableBody.addEventListener("click", (event) => {
        const target = event.target;
        if (!(target instanceof Element)) {
            return;
        }

        const editButton = target.closest("button[data-action='edit']");
        if (!(editButton instanceof HTMLButtonElement)) {
            return;
        }

        const productData = {
            id: editButton.dataset.id || "",
            name: editButton.dataset.name || "",
            price: editButton.dataset.price || "",
            stock: editButton.dataset.stock || "0",
            categoryId: editButton.dataset.categoryId || "",
            discount: editButton.dataset.discount || "0",
            onSale: editButton.dataset.onSale || "0",
            imageUrl: editButton.dataset.imageUrl || "",
        };

        setEditMode(productData);

        if (productId instanceof HTMLInputElement) {
            productId.value = productData.id;
        }

        if (productName instanceof HTMLInputElement) {
            productName.value = productData.name;
        }

        if (productPrice instanceof HTMLInputElement) {
            productPrice.value = productData.price;
        }

        if (productStock instanceof HTMLInputElement) {
            productStock.value = productData.stock;
        }

        if (productDiscount instanceof HTMLInputElement) {
            productDiscount.value = productData.discount;
        }

        if (productCategory instanceof HTMLSelectElement) {
            productCategory.value = productData.categoryId;
        }

        if (productSale instanceof HTMLInputElement) {
            productSale.checked = productData.onSale === "1";
        }

        if (productImagePreview instanceof HTMLImageElement) {
            productImagePreview.src = productData.imageUrl;
        }

        if (productImage instanceof HTMLInputElement) {
            productImage.value = "";
        }

        if (removeImage instanceof HTMLInputElement) {
            removeImage.checked = false;
        }

        if (listView && editorView) {
            listView.classList.add("is-hidden");
            editorView.classList.remove("is-hidden");
        }
    });
}
