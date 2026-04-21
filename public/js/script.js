const togglePasswordButton = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");
const eyeIcon = document.getElementById("eyeIcon");

if (togglePasswordButton && passwordInput && eyeIcon) {
    togglePasswordButton.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.textContent = "Hide";
        } else {
            passwordInput.type = "password";
            eyeIcon.textContent = "Show";
        }
    });
}

function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");

    if (sidebar) {
        sidebar.classList.toggle("show");
    }
}

document.addEventListener("click", function (event) {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = event.target.closest('button[onclick="toggleSidebar()"]');

    if (!sidebar) {
        return;
    }

    if (
        !sidebar.contains(event.target) &&
        !toggleBtn &&
        window.innerWidth <= 768
    ) {
        sidebar.classList.remove("show");
    }
});
