function toggleDropdown(id) {
    const menu = document.getElementById(id);
    const isHidden = menu.classList.contains("hidden");

    document
        .querySelectorAll("[id^='userMenu-']")
        .forEach((el) => el.classList.add("hidden"));

    if (isHidden) {
        menu.classList.remove("hidden");
    }
}

function closeDropdown(id) {
    document.getElementById(id).classList.add("hidden");
}

document.addEventListener("click", (event) => {
    document.querySelectorAll("[id^='userMenu-']").forEach((menu) => {
        if (menu.classList.contains("hidden")) return;

        const trigger = menu.previousElementSibling;
        if (menu.contains(event.target) || trigger?.contains(event.target))
            return;

        menu.classList.add("hidden");
    });
});

window.toggleDropdown = toggleDropdown;
window.closeDropdown = closeDropdown;
