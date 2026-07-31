export function switchTab(tab, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.querySelectorAll("[data-tab-panel]").forEach((panel) => {
        const isActive = panel.dataset.tabPanel === tab;
        panel.classList.toggle("hidden", !isActive);
        panel.classList.toggle("grid", isActive);
    });

    container.querySelectorAll("[data-tab-btn]").forEach((btn) => {
        const isActive = btn.dataset.tabBtn === tab;
        btn.classList.toggle("text-[#76ABAE]", isActive);
        btn.classList.toggle("border-[#76ABAE]", isActive);
        btn.classList.toggle("text-[#0A2947]/50", !isActive);
        btn.classList.toggle("border-transparent", !isActive);
    });
}

window.switchTab = switchTab;
