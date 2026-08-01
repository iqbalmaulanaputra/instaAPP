function escapeHtml(text) {
    const div = document.createElement("div");
    div.textContent = text ?? "";
    return div.innerHTML;
}

function buildFollowRow(user) {
    const row = document.createElement("div");
    row.setAttribute("data-follow-row", "");
    row.dataset.userId = user.id;
    row.dataset.username = user.username;
    row.dataset.name = user.name;
    row.dataset.avatar = user.avatar || "";
    row.className = "flex items-center justify-between px-4 py-3";

    const avatarHtml = user.avatar
        ? `<img src="${escapeHtml(user.avatar)}" class="w-full h-full object-cover">`
        : escapeHtml((user.username || "?").charAt(0).toUpperCase());

    row.innerHTML = `
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-[#ECF0F3] overflow-hidden shrink-0 flex items-center justify-center font-bold text-[#76ABAE] text-sm">
                ${avatarHtml}
            </div>
            <div>
                <p class="text-sm font-semibold text-[#0A2947]">&#64;${escapeHtml(user.username)}</p>
                <p class="text-xs text-[#0A2947]/50">${escapeHtml(user.name)}</p>
            </div>
        </div>
        <button type="button" class="text-xs font-semibold text-[#0A2947]/50">Mengikuti</button>
    `;

    const btn = row.querySelector("button");
    btn.addEventListener("click", () =>
        toggleFollow(user.id, btn, { removeOnUnfollow: true }),
    );

    return row;
}

function updateEmptyState(panel, message) {
    const hasRows = panel.querySelectorAll("[data-follow-row]").length > 0;
    let emptyMsg = panel.querySelector("[data-empty-message]");

    if (!hasRows) {
        if (!emptyMsg) {
            emptyMsg = document.createElement("p");
            emptyMsg.setAttribute("data-empty-message", "");
            emptyMsg.className = "text-center text-sm text-[#0A2947]/40 py-6";
            emptyMsg.textContent = message;
            panel.appendChild(emptyMsg);
        }
    } else if (emptyMsg) {
        emptyMsg.remove();
    }
}

function updateTabHeaderCount(tab) {
    const panel = document.querySelector(
        `#followListTabs [data-tab-panel="${tab}"]`,
    );
    const btn = document.querySelector(
        `#followListTabs [data-tab-btn="${tab}"]`,
    );
    if (!panel || !btn) return;

    const count = panel.querySelectorAll("[data-follow-row]").length;
    const label = tab === "followers" ? "Pengikut" : "Mengikuti";
    btn.textContent = `${label} (${count})`;
}

function syncFollowingTab(userId, following, sourceRow) {
    const followingPanel = document.querySelector(
        '#followListTabs [data-tab-panel="following"]',
    );
    if (!followingPanel) return;

    const existing = followingPanel.querySelector(`[data-user-id="${userId}"]`);

    if (following && !existing && sourceRow) {
        const user = {
            id: userId,
            username: sourceRow.dataset.username,
            name: sourceRow.dataset.name,
            avatar: sourceRow.dataset.avatar,
        };
        followingPanel.prepend(buildFollowRow(user));
    } else if (!following && existing) {
        existing.remove();
    }

    updateEmptyState(followingPanel, "Belum mengikuti siapa pun.");
    updateTabHeaderCount("following");
}

function updateFollowingCount(delta) {
    const el = document.getElementById("followingCount");
    if (!el) return;
    const current = parseInt(el.textContent, 10) || 0;
    el.textContent = current + delta;
}

async function toggleFollow(userId, button, options = {}) {
    if (!window.requireAuth()) return;

    const { data } = await api.post(`/user/${userId}/follow`);
    if (!data) return;

    if (data.following) {
        button.textContent = "Mengikuti";
        button.classList.remove("text-[#76ABAE]", "hover:text-[#5CADB1]");
        button.classList.add("text-[#0A2947]/50");
    } else {
        button.textContent = "Ikuti";
        button.classList.add("text-[#76ABAE]", "hover:text-[#5CADB1]");
        button.classList.remove("text-[#0A2947]/50");
    }

    updateFollowingCount(data.following ? 1 : -1);

    const row = button.closest("[data-follow-row]");

    syncFollowingTab(userId, data.following, row);

    if (row) {
        if (data.following && options.removeOnFollow) {
            row.remove();
        } else if (!data.following && options.removeOnUnfollow) {
            row.remove();
        }
    }
}

window.toggleFollow = toggleFollow;
