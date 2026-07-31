import {
    clearFieldErrors,
    applyFieldErrors,
    applyGeneralError,
} from "./formErrors";

const loginFieldMap = {
    login: "loginFieldError",
    password: "loginPasswordError",
};

const registerFieldMap = {
    name: "registerNameError",
    username: "registerUsernameError",
    email: "registerEmailError",
    password: "registerPasswordError",
};

function handleUnexpectedResponse(generalErrorId) {
    applyGeneralError(
        generalErrorId,
        "Server memberi respons tak terduga. Cek console (F12) untuk detail, kemungkinan ada error di server.",
    );
}

async function submitLogin(url) {
    clearFieldErrors([...Object.values(loginFieldMap), "loginGeneralError"]);

    const payload = {
        login: document.getElementById("loginField").value,
        password: document.getElementById("loginPassword").value,
    };

    const { ok, data } = await api.post(url, payload);

    if (ok) {
        if (!data?.redirect) {
            handleUnexpectedResponse("loginGeneralError");
            return;
        }
        window.isAuthenticated = true;
        window.location.href = data.redirect;
        return;
    }

    if (data?.errors && applyFieldErrors(data.errors, loginFieldMap)) {
        return;
    }

    applyGeneralError(
        "loginGeneralError",
        data?.message ?? "Terjadi kesalahan, coba lagi.",
    );
}

async function submitRegister(url) {
    clearFieldErrors([
        ...Object.values(registerFieldMap),
        "registerGeneralError",
    ]);

    const payload = {
        name: document.getElementById("registerName").value,
        username: document.getElementById("registerUsername").value,
        email: document.getElementById("registerEmail").value,
        password: document.getElementById("registerPassword").value,
        password_confirmation: document.getElementById(
            "registerPasswordConfirmation",
        ).value,
    };

    const { ok, data } = await api.post(url, payload);

    if (ok) {
        if (!data?.redirect) {
            handleUnexpectedResponse("registerGeneralError");
            return;
        }
        window.isAuthenticated = true;
        window.location.href = data.redirect;
        return;
    }

    if (data?.errors && applyFieldErrors(data.errors, registerFieldMap)) {
        return;
    }

    applyGeneralError(
        "registerGeneralError",
        data?.message ?? "Terjadi kesalahan, coba lagi.",
    );
}

window.submitLogin = submitLogin;
window.submitRegister = submitRegister;
