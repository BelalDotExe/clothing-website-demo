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

