function triggerPostImageInput() {
    if (!window.requireAuth()) return;
    document.getElementById("createPostImageInput").click();
}

function previewPostImage(input) {
    const file = input.files[0];
    if (!file) return;

    const preview = document.getElementById("createPostImagePreview");
    preview.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-full h-full object-cover">`;
}

async function submitCreatePost(url) {
    if (!window.requireAuth()) return;

    const errorBox = document.getElementById("createPostError");
    errorBox.classList.add("hidden");
    errorBox.textContent = "";

    const imageInput = document.getElementById("createPostImageInput");
    if (!imageInput.files[0]) {
        errorBox.textContent = "Silakan pilih foto terlebih dahulu.";
        errorBox.classList.remove("hidden");
        return;
    }

    const formData = new FormData();
    formData.append("image", imageInput.files[0]);
    formData.append(
        "caption",
        document.getElementById("createPostCaption").value,
    );

    const { ok, data } = await api.post(url, formData);

    if (!ok) {
        const firstError = data?.errors
            ? Object.values(data.errors)[0][0]
            : (data?.message ?? "Terjadi kesalahan, coba lagi.");
        errorBox.textContent = firstError;
        errorBox.classList.remove("hidden");
        return;
    }

    if (!data?.message) {
        errorBox.textContent =
            "Server memberi respons tak terduga. Cek console (F12) untuk detail.";
        errorBox.classList.remove("hidden");
        return;
    }

    showToast("success", data.message);
    closeModal("createPostModal");
    setTimeout(() => window.location.reload(), 600);
}

window.triggerPostImageInput = triggerPostImageInput;
window.previewPostImage = previewPostImage;
window.submitCreatePost = submitCreatePost;
