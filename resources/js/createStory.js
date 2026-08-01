function previewStoryImage(input) {
    const file = input.files[0];
    if (!file) return;

    const preview = document.getElementById("createStoryImagePreview");
    preview.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-full h-full object-cover">`;
}

async function submitCreateStory(url) {
    if (!window.requireAuth()) return;

    const errorBox = document.getElementById("createStoryError");
    errorBox.classList.add("hidden");
    errorBox.textContent = "";

    const imageInput = document.getElementById("createStoryImageInput");
    if (!imageInput.files[0]) {
        errorBox.textContent = "Silakan pilih foto terlebih dahulu.";
        errorBox.classList.remove("hidden");
        return;
    }

    const formData = new FormData();
    formData.append("image", imageInput.files[0]);

    const { ok, data } = await api.post(url, formData);

    if (!ok) {
        const firstError = data?.errors
            ? Object.values(data.errors)[0][0]
            : (data?.message ?? "Terjadi kesalahan, coba lagi.");
        errorBox.textContent = firstError;
        errorBox.classList.remove("hidden");
        return;
    }

    showToast("success", data.message);
    closeModal("createStoryModal");
    setTimeout(() => window.location.reload(), 600);
}

window.previewStoryImage = previewStoryImage;
window.submitCreateStory = submitCreateStory;
