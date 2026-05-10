const sidebar = document.getElementById("dashboardSidebar");
const toggleButton = document.getElementById("sidebarToggle");
const hbNotif = document.querySelector(".hb-notif");
const hbNotifBtn = document.querySelector(".hb-notif-btn");
const hbNotifPanel = document.querySelector(".hb-notif-panel");
const hbNotifList = document.querySelector(".hb-notif-list");
const hbNotifDot = document.querySelector(".hb-notif-dot");
const hbNotifClear = document.querySelector(".hb-notif-clear");

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
