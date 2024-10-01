import {
    getBackendUrl,
    getBackendUrlApi,
    getFirstName,
    showToast
} from "./../_shared/functions.js";



// Formulário de Login
const message = document.querySelector("#message");
const formLogin = document.querySelector("#formLogin");
formLogin.addEventListener("submit", async (e) => {
    e.preventDefault();
    fetch(getBackendUrlApi("users/login"), {
        method: "POST",
        body: new FormData(formLogin)
    }).then((response) => {
        response.json().then((data) => {
            if (data.type === "error") {
                showToast(data.message); // Exibe mensagem de erro
                return;
            }

            // Salva as informações do usuário no LocalStorage
            localStorage.setItem("userAuth", JSON.stringify(data.user));
            
            // Mostra mensagem de boas-vindas
            showToast(`Olá, ${getFirstName(data.user.name)}, como vai!`);
            
            // Redireciona após 3 segundos
            setTimeout(() => {
                window.location.href = getBackendUrl("app");
            }, 3000);
        }).catch((error) => {
            console.error("Erro ao processar a resposta:", error);
            showToast("Erro no processamento. Tente novamente.");
        });
    }).catch((error) => {
        console.error("Erro na requisição:", error);
        showToast("Erro na conexão. Tente novamente.");
    });
});
