import {
    getBackendUrl,
    getBackendUrlApi,
    getFirstName
} from "./../_shared/functions.js";

const formLogin = document.querySelector("#formLogin");
const messageDiv = document.querySelector("#message");

formLogin.addEventListener("submit", async (e) => {
    e.preventDefault();
    
    messageDiv.style.display = "none";
    messageDiv.textContent = "";
    messageDiv.style.color = "";

    fetch(getBackendUrlApi("/login"), {
        method: "POST",
        body: new FormData(formLogin)
    })
    .then(response => response.json())
    .then((data) => {
        console.log(data);

        if (data.type === "error") {
            messageDiv.style.display = "block";
            messageDiv.textContent = data.message;
            messageDiv.style.color = "#cc0000";
            return;
        }

        localStorage.setItem("userAuth", JSON.stringify(data.user));
        messageDiv.style.display = "block";
        messageDiv.textContent = `Olá, ${getFirstName(data.user.name)} como vai!`;
        messageDiv.style.color = "#28a745";

        if (data.user.email === "admin@gmail.com") {
            // Pergunta de segurança para o administrador
            const resposta = prompt("Pergunta de segurança: Qual é o código secreto?");
            if (resposta === "brunolindo") {
                window.location.href = getBackendUrl("admin");
            } else {
                messageDiv.style.display = "block";
                messageDiv.textContent = "Resposta incorreta!";
                messageDiv.style.color = "#cc0000";
                return;
            }
        } else {
            setTimeout(() => {
                window.location.href = getBackendUrl("app");
            }, 3000);
        }
    })
    .catch((error) => {
        console.error("Erro:", error);
        messageDiv.style.display = "block";
        messageDiv.textContent = "Erro inesperado. Tente novamente mais tarde.";
        messageDiv.style.color = "#cc0000";
    });
});
