import {
    getBackendUrl,
    getBackendUrlApi,
    getFirstName
} from "./../_shared/functions.js";

const formLogin = document.querySelector("#formLogin");
const messageDiv = document.querySelector("#message");  // Captura o elemento de mensagem

formLogin.addEventListener("submit", async (e) => {
    e.preventDefault();
    
    // Limpa mensagens anteriores
    messageDiv.style.display = "none";
    messageDiv.textContent = "";
    messageDiv.style.color = ""; // Reseta a cor

    fetch(getBackendUrlApi("users/login"), {
        method: "POST",
        body: new FormData(formLogin)
    })
    .then(response => response.json())  // Parseia automaticamente o JSON da resposta
    .then((data) => {
        console.log(data);  // Exibe o dado retornado no console para verificar

        if (data.type === "error") {  // Se for erro
            // Exibe mensagem de erro na div com cor vermelha
            messageDiv.style.display = "block";  // Exibe a mensagem
            messageDiv.textContent = data.message;  // Mostra o texto de erro
            messageDiv.style.color = "#cc0000";  // Define a cor vermelha
            return;
        }

        // Sucesso: Exibe mensagem de boas-vindas
        localStorage.setItem("userAuth", JSON.stringify(data.user));
        messageDiv.style.display = "block";
        messageDiv.textContent = `Olá, ${getFirstName(data.user.name)} como vai!`;  // Exibe mensagem de sucesso
        messageDiv.style.color = "#28a745";  // Define a cor verde

        setTimeout(() => {
            window.location.href = getBackendUrl("app");
        }, 3000);
    })
    .catch((error) => {
        console.error("Erro:", error);
        // Exibe mensagem de erro genérica em caso de falha na requisição
        messageDiv.style.display = "block";
        messageDiv.textContent = "Erro inesperado. Tente novamente mais tarde.";  // Mensagem genérica em caso de erro
        messageDiv.style.color = "#cc0000";  // Define a cor vermelha
    });
});
