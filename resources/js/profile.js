import {
    clearFieldErrors,
    applyFieldErrors,
    applyGeneralError,
} from "./formErrors";

const profileFieldMap = {
    name: "profileNameError",
    username: "profileUsernameError",
    email: "profileEmailError",
    bio: "profileBioError",
    avatar: "profileAvatarError",
};

const passwordFieldMap = {
    current_password: "currentPasswordError",
    password: "newPasswordError",
};

function previewAvatar(input) {
    const file = input.files[0];
    if (!file) return;

    const preview = document.getElementById("profileAvatarPreview");
    preview.innerHTML = `<img src="${URL.createObjectURL(file)}" alt="avatar" class="w-full h-full object-cover">`;
}

async function submitProfileUpdate(url) {
    clearFieldErrors([
        ...Object.values(profileFieldMap),
        "profileGeneralError",
    ]);

    const formData = new FormData();
    formData.append("_method", "PUT");
    formData.append("name", document.getElementById("profileName").value);
    formData.append(
        "username",
        document.getElementById("profileUsername").value,
    );
    formData.append("email", document.getElementById("profileEmail").value);
    formData.append("bio", document.getElementById("profileBio").value);

    const avatarInput = document.getElementById("profileAvatarInput");
    if (avatarInput.files[0]) {
        formData.append("avatar", avatarInput.files[0]);
    }

    const { ok, data } = await api.post(url, formData);

    if (!ok) {
        if (data?.errors && applyFieldErrors(data.errors, profileFieldMap)) {
            return;
        }
        applyGeneralError(
            "profileGeneralError",
            data?.message ?? "Terjadi kesalahan, coba lagi.",
        );
        return;
    }

    if (!data?.message) {
        applyGeneralError(
            "profileGeneralError",
            "Server memberi respons tak terduga. Cek console (F12) untuk detail.",
        );
        return;
    }

    showToast("success", data.message);
    closeModal("settingsModal");
    setTimeout(() => window.location.reload(), 600);
}

async function submitPasswordUpdate(url) {
    clearFieldErrors([
        ...Object.values(passwordFieldMap),
        "passwordGeneralError",
    ]);

    const payload = {
        current_password: document.getElementById("currentPassword").value,
        password: document.getElementById("newPassword").value,
        password_confirmation: document.getElementById(
            "newPasswordConfirmation",
        ).value,
    };

    const { ok, data } = await api.put(url, payload);

    if (!ok) {
        if (data?.errors && applyFieldErrors(data.errors, passwordFieldMap)) {
            return;
        }
        applyGeneralError(
            "passwordGeneralError",
            data?.message ?? "Terjadi kesalahan, coba lagi.",
        );
        return;
    }

    if (!data?.message) {
        applyGeneralError(
            "passwordGeneralError",
            "Server memberi respons tak terduga. Cek console (F12) untuk detail.",
        );
        return;
    }

    showToast("success", data.message);
    document.getElementById("currentPassword").value = "";
    document.getElementById("newPassword").value = "";
    document.getElementById("newPasswordConfirmation").value = "";
}

window.previewAvatar = previewAvatar;
window.submitProfileUpdate = submitProfileUpdate;
window.submitPasswordUpdate = submitPasswordUpdate;
