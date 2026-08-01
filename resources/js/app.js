import Swal from "sweetalert2";

window.Swal = Swal;
window.isAuthenticated = document.body.dataset.authenticated === "1";

document.addEventListener("DOMContentLoaded", () => {
    const success = document.body.dataset.flashSuccess;
    const info = document.body.dataset.flashInfo;
    if (success) showToast("success", success);
    if (info) showToast("info", info);
});

window.showToast = function (icon, message) {
    Swal.fire({
        toast: true,
        position: "top-end",
        icon,
        title: message,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
};

window.requireAuth = function () {
    if (!window.isAuthenticated) {
        openModal("authModal");
        return false;
    }
    return true;
};

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').content;
}

async function apiRequest(url, method = "GET", body = null) {
    const options = {
        method,
        headers: {
            "X-CSRF-TOKEN": getCsrfToken(),
            "X-Requested-With": "XMLHttpRequest",
            Accept: "application/json",
        },
    };

    if (body instanceof FormData) {
        options.body = body;
    } else if (body) {
        options.headers["Content-Type"] = "application/json";
        options.body = JSON.stringify(body);
    }

    const response = await fetch(url, options);
    const rawText = await response.text();

    let data = null;
    try {
        data = rawText ? JSON.parse(rawText) : null;
    } catch (e) {
        console.error(
            "Respons bukan JSON valid dari",
            url,
            "- status:",
            response.status,
            "- redirected:",
            response.redirected,
            "- final url:",
            response.url,
            "- isi mentah:",
            rawText,
        );
    }

    return { ok: response.ok, status: response.status, data };
}

window.api = {
    get: (url) => apiRequest(url, "GET"),
    post: (url, body) => apiRequest(url, "POST", body),
    put: (url, body) => apiRequest(url, "PUT", body),
    delete: (url, body) => apiRequest(url, "DELETE", body),
};

import "./modal";
import "./authTab";
import "./comment";
import "./save";
import "./like";
import "./tabs";
import "./auth";
import "./dropdown";
import "./profile";
import "./logout";
import "./createPost";
import "./follow";
import "./createStory";
import "./storyViewer";
