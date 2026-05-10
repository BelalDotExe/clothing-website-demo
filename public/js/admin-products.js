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
const hbNotif = document.querySelector(".hb-notif");
const hbNotifBtn = document.querySelector(".hb-notif-btn");
const hbNotifPanel = document.querySelector(".hb-notif-panel");
const hbNotifList = document.querySelector(".hb-notif-list");
const hbNotifDot = document.querySelector(".hb-notif-dot");
const hbNotifClear = document.querySelector(".hb-notif-clear");

const storeAction =
    form instanceof HTMLFormElement ? form.dataset.storeAction || form.action : "";
const updateActionTemplate =
    form instanceof HTMLFormElement ? form.dataset.updateActionTemplate || "" : "";

function hbEsc(text) {
    return String(text)
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#039;");
}

function hbWhen(isoValue) {
    if (!isoValue) {
        return "";
    }

    const date = new Date(isoValue);
    if (Number.isNaN(date.getTime())) {
        return "";
    }

    return date.toLocaleString();
}

async function hbLoadNotifs() {
    if (!hbNotifList || !hbNotifDot) {
        return;
    }

    try {
        const response = await fetch("/admin/hb-notifs", {
            headers: { Accept: "application/json" },
        });
        if (!response.ok) {
            throw new Error("Unable to load notifications");
        }

        const payload = await response.json();
        const items = Array.isArray(payload.items) ? payload.items : [];
        hbNotifDot.style.display = (payload.count || 0) > 0 ? "inline-block" : "none";

        if (items.length === 0) {
            hbNotifList.innerHTML = '<p class="hb-notif-empty">No notifications yet.</p>';
            return;
        }

        hbNotifList.innerHTML = items
            .map(
                (item) => `
                <article class="hb-notif-item">
                    <p class="hb-notif-title">${hbEsc(item.title || "Notification")}</p>
                    <p class="hb-notif-msg">${hbEsc(item.msg || "")}</p>
                    <p class="hb-notif-time">${hbEsc(hbWhen(item.sent_at))}</p>
                </article>
            `
            )
            .join("");
    } catch (error) {
        hbNotifList.innerHTML = '<p class="hb-notif-empty">Could not load notifications.</p>';
    }
}

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

if (hbNotifBtn && hbNotifPanel) {
    hbNotifBtn.addEventListener("click", async () => {
        const nowHidden = !hbNotifPanel.hidden;
        hbNotifPanel.hidden = nowHidden;
        if (!nowHidden) {
            await hbLoadNotifs();
        }
    });

    document.addEventListener("click", (event) => {
        if (!(event.target instanceof Element) || !hbNotif) {
            return;
        }

        if (!hbNotif.contains(event.target)) {
            hbNotifPanel.hidden = true;
        }
    });
}

if (hbNotifClear) {
    hbNotifClear.addEventListener("click", async () => {
        try {
            const token = document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute("content");
            const response = await fetch("/admin/hb-notifs/clear", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": token || "",
                    Accept: "application/json",
                },
            });

            if (!response.ok) {
                throw new Error("Unable to clear notifications");
            }
        } finally {
            await hbLoadNotifs();
        }
    });
}

hbLoadNotifs();

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
