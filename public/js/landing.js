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
