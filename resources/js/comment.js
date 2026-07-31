async function addComment(postId) {
    if (!window.requireAuth()) return;

    const input = document.getElementById(`commentInput-${postId}`);
    const text = input.value.trim();
    if (!text) return;

    const { status, data } = await api.post(`/post/${postId}/comments`, {
        comment: text,
    });

    if (status === 401) {
        openModal("authModal");
        return;
    }

    if (!data?.comment) return;

    const list = document.getElementById(`commentList-${postId}`);

    const item = document.createElement("div");
    item.className = "flex items-start gap-3 px-4 py-3";

    const avatar = document.createElement("div");
    avatar.className = "w-8 h-8 rounded-full bg-[#ECF0F3] shrink-0";

    const p = document.createElement("p");
    p.className = "text-sm text-[#0A2947]";

    const span = document.createElement("span");
    span.className = "font-semibold";
    span.textContent = "@" + data.comment.username;

    p.appendChild(span);
    p.appendChild(document.createTextNode(" " + data.comment.text));

    item.appendChild(avatar);
    item.appendChild(p);
    list.appendChild(item);

    const countEl = document.getElementById(`commentCount-${postId}`);
    if (countEl) countEl.textContent = data.comments_count;

    input.value = "";
}

window.addComment = addComment;
