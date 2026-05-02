const key = "aura_cart";
const fmt = new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" });

const el = {
    list: document.getElementById("cartList"),
    itemText: document.getElementById("itemText"),
    subText: document.getElementById("subText"),
    subVal: document.getElementById("subVal"),
    totalVal: document.getElementById("totalVal"),
    cartCount: document.getElementById("cartCount"),
    checkoutBtn: document.getElementById("checkoutBtn"),
};

function getCart() {
    try {
        const raw = localStorage.getItem(key);
        const list = raw ? JSON.parse(raw) : [];
        return Array.isArray(list) ? list : [];
    } catch {
        return [];
    }
}

function setCart(list) {
    localStorage.setItem(key, JSON.stringify(list));
}

function money(v) {
    return fmt.format(Number(v) || 0);
}

function stockText(stock) {
    if (stock > 0 && stock <= 2) {
        return { t: `Only ${stock} left in stock`, low: true };
    }

    return { t: "In Stock", low: false };
}

function sumQty(list) {
    return list.reduce((n, i) => n + (Number(i.qty) || 0), 0);
}

function sumTotal(list) {
    return list.reduce((n, i) => n + (Number(i.price) || 0) * (Number(i.qty) || 0), 0);
}

function checkout() {
    alert("Checkout functionality is not implemented in this demo.");
}

function draw() {
    const list = getCart();
    const qty = sumQty(list);
    const total = sumTotal(list);

    el.itemText.textContent = `${qty} item${qty === 1 ? "" : "s"}`;
    el.subText.textContent = `Subtotal (${qty} item${qty === 1 ? "" : "s"})`;
    el.subVal.textContent = money(total);
    el.totalVal.textContent = money(total);
    el.cartCount.textContent = String(qty);
    el.cartCount.style.display = qty > 0 ? "inline-flex" : "none";

    if (!list.length) {
        el.list.innerHTML = '<div class="empty">Your cart is empty. Add items from categories to see them here.</div>';
        return;
    }

    el.list.innerHTML = list
        .map((i) => {
            const s = stockText(Number(i.stock) || 0);
            const qty = Number(i.qty) || 1;
            const stock = Number(i.stock) || 0;
            const atMax = stock > 0 && qty >= stock;
            return `
                <article class="cart-item">
                    <img src="${i.image}" alt="${i.name}">
                    <div class="item-info">
                        <div class="item-head">
                            <div>
                                <h3>${i.name}</h3>
                                <div class="item-meta">${i.category || "Item"}</div>
                                <div class="item-stock ${s.low ? "low" : ""}">${s.t}</div>
                            </div>
                            <div class="item-price">${money(i.price)}</div>
                        </div>
                        <div class="item-foot">
                            <div class="qty">
                                <button type="button" data-act="dec" data-id="${i.id}">-</button>
                                <span>${qty}</span>
                                <button type="button" data-act="inc" data-id="${i.id}" ${atMax ? "disabled" : ""}>+</button>
                            </div>
                            <button type="button" class="remove" data-act="rm" data-id="${i.id}">Remove</button>
                        </div>
                    </div>
                </article>
            `;
        })
        .join("");
}

el.list.addEventListener("click", (e) => {
    const t = e.target;
    if (!(t instanceof Element)) {
        return;
    }

    const btn = t.closest("button[data-act]");
    if (!(btn instanceof HTMLButtonElement)) {
        return;
    }

    const act = btn.dataset.act;
    const id = Number(btn.dataset.id || 0);
    const list = getCart();
    const idx = list.findIndex((i) => Number(i.id) === id);

    if (idx < 0) {
        return;
    }

    if (act === "inc") {
        const stock = Math.max(0, Number(list[idx].stock) || 0);
        const nextQty = (Number(list[idx].qty) || 0) + 1;

        if (stock > 0) {
            list[idx].qty = Math.min(nextQty, stock);
        } else {
            list[idx].qty = nextQty;
        }
    }

    if (act === "dec") {
        const q = (Number(list[idx].qty) || 0) - 1;
        if (q <= 0) {
            list.splice(idx, 1);
        } else {
            list[idx].qty = q;
        }
    }

    if (act === "rm") {
        list.splice(idx, 1);
    }

    setCart(list);
    draw();
});

draw();
