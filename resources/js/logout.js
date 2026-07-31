async function logout(url) {
    const { ok, data } = await api.post(url);

    if (ok) {
        window.location.href = data.redirect;
    }
}

window.logout = logout;
