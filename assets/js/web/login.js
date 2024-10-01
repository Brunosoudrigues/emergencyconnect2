import {
    getBackendUrl,
    getBackendUrlApi,
    getFirstName,
    showToast
} from "./../_shared/functions.js";



const formLogin = document.querySelector("#formLogin");
formLogin.addEventListener("submit", async (e) => {
    e.preventDefault();
    fetch(getBackendUrlApi("users/login"), {
        method: "POST",
        body: new FormData(formLogin)
    }).then((response) => {
        console.log(response); // Adicione isso para inspecionar a resposta
        response.text().then((data) => {  // Use .text() temporariamente para ver o que está sendo retornado
            console.log(data); // Veja o conteúdo da resposta no console
            try {
                const jsonData = JSON.parse(data);  // Tente analisar o JSON manualmente
                if (jsonData.type == "error") {
                    showToast(jsonData.message);
                    return;
                }
                localStorage.setItem("userAuth", JSON.stringify(jsonData.user));
                showToast(`Olá, ${getFirstName(jsonData.user.name)} como vai!`);
                setTimeout(() => {
                    window.location.href = getBackendUrl("app");
                }, 3000);
            } catch (e) {
                console.error("Erro ao analisar JSON:", e);
                showToast("Erro inesperado. Tente novamente mais tarde.");
            }
        });
    });
});
