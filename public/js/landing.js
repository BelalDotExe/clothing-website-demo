const menuToggle =
    document.getElementById("hbMenuToggle") ||
    document.getElementById("menuToggle");
const mainNav =
    document.getElementById("hbNav") || document.getElementById("mainNav");

if (menuToggle && mainNav) {
    menuToggle.addEventListener("click", () => {
        const isOpen = mainNav.classList.toggle("is-open");
        menuToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });
}

const addButtons = document.querySelectorAll(".add-cart-btn");
addButtons.forEach((button) => {
    if (!(button instanceof HTMLButtonElement)) {
        return;
    }

    button.addEventListener("click", () => {
        button.textContent = "Added";
        setTimeout(() => {
            button.textContent = "Add to Cart";
        }, 1200);
    });
});

const promoBanner = document.getElementById("promo-banner");
const promoMessages = promoBanner
    ? Array.from(promoBanner.querySelectorAll(".banner-text"))
    : [];

if (promoMessages.length > 1) {
    let activePromoIndex = promoMessages.findIndex((message) =>
        message.classList.contains("active")
    );

    if (activePromoIndex < 0) {
        activePromoIndex = 0;
        promoMessages[activePromoIndex].classList.add("active");
    }

    promoMessages.forEach((message, index) => {
        message.setAttribute(
            "aria-hidden",
            index === activePromoIndex ? "false" : "true"
        );
    });

    setInterval(() => {
        promoMessages[activePromoIndex].classList.remove("active");
        promoMessages[activePromoIndex].setAttribute("aria-hidden", "true");

        activePromoIndex = (activePromoIndex + 1) % promoMessages.length;

        promoMessages[activePromoIndex].classList.add("active");
        promoMessages[activePromoIndex].setAttribute("aria-hidden", "false");
    }, 5000);
}
