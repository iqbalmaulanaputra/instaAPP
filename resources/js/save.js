async function toggleSave(postId, button) {
    if (!window.requireAuth()) return;

    const { status, data } = await api.post(`/post/${postId}/save`);

    if (status === 401) {
        openModal("authModal");
        return;
    }

    if (!data) return;

    const icon = button.querySelector("i");

    if (data.saved) {
        icon.classList.remove("bx-bookmark");
        icon.classList.add("bxs-bookmark");
        button.classList.add("text-[#76ABAE]");
    } else {
        icon.classList.remove("bxs-bookmark");
        icon.classList.add("bx-bookmark");
        button.classList.remove("text-[#76ABAE]");
    }
}

window.toggleSave = toggleSave;
