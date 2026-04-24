const passwordInput = document.getElementById("password");
const togglePasswordButton = document.getElementById("togglePassword");

if (passwordInput && togglePasswordButton) {
    togglePasswordButton.addEventListener("click", () => {
        const isPassword = passwordInput.type === "password";
        passwordInput.type = isPassword ? "text" : "password";
        togglePasswordButton.setAttribute(
            "aria-label",
            isPassword ? "Hide password" : "Show password"
        );
    });
}

