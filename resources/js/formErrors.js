export function clearFieldErrors(ids) {
    ids.forEach((id) => {
        const el = document.getElementById(id);
        if (!el) return;
        el.textContent = "";
        el.classList.add("hidden");
    });
}

export function applyFieldErrors(errors, fieldMap) {
    let handled = false;

    Object.entries(fieldMap).forEach(([field, errorElId]) => {
        const el = document.getElementById(errorElId);
        if (!el || !errors?.[field]) return;

        el.textContent = errors[field][0];
        el.classList.remove("hidden");
        handled = true;
    });

    return handled;
}

export function applyGeneralError(elId, message) {
    const el = document.getElementById(elId);
    if (!el) return;
    el.textContent = message;
    el.classList.remove("hidden");
}
