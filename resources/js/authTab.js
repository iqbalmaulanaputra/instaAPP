// resources/js/auth-tab.js

export function switchAuthTab(tab) {
    const loginPanel = document.getElementById("loginPanel");
    const registerPanel = document.getElementById("registerPanel");
    const tabLoginBtn = document.getElementById("tabLoginBtn");
    const tabRegisterBtn = document.getElementById("tabRegisterBtn");

    const activeClasses = ["text-[#76ABAE]", "border-[#76ABAE]"];
    const inactiveClasses = ["text-[#0A2947]/50", "border-transparent"];

    if (tab === "login") {
        loginPanel.classList.remove("hidden");
        loginPanel.classList.add("flex");
        registerPanel.classList.add("hidden");
        registerPanel.classList.remove("flex");

        tabLoginBtn.classList.add(...activeClasses);
        tabLoginBtn.classList.remove(...inactiveClasses);

        tabRegisterBtn.classList.add(...inactiveClasses);
        tabRegisterBtn.classList.remove(...activeClasses);
    } else {
        registerPanel.classList.remove("hidden");
        registerPanel.classList.add("flex");
        loginPanel.classList.add("hidden");
        loginPanel.classList.remove("flex");

        tabRegisterBtn.classList.add(...activeClasses);
        tabRegisterBtn.classList.remove(...inactiveClasses);

        tabLoginBtn.classList.add(...inactiveClasses);
        tabLoginBtn.classList.remove(...activeClasses);
    }
}

window.switchAuthTab = switchAuthTab;
