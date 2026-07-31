async function toggleLike(postId, button) {
    if (!window.requireAuth()) return;

    const { status, data } = await api.post(`/post/${postId}/like`);

    if (status === 401) {
        openModal("authModal");
        return;
    }

    if (!data) return;

    const icon = button.querySelector("i");
    const countEl = document.getElementById(`likeCount-${postId}`);

    if (data.liked) {
        icon.classList.remove("bx-heart");
        icon.classList.add("bxs-heart");
        button.classList.add("text-rose-500");
    } else {
        icon.classList.remove("bxs-heart");
        icon.classList.add("bx-heart");
        button.classList.remove("text-rose-500");
    }

    if (countEl) countEl.textContent = data.likes_count;
    button.title = `${data.likes_count} suka`;
}

window.toggleLike = toggleLike;
