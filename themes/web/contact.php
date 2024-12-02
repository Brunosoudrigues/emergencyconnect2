<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir FAQ</title>
    <style>
       /* Estilos gerais */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Container do formulário */
form {
    background-color: #ffffff;
    border-radius: 12px;
    padding: 30px;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

form:hover {
    transform: translateY(-5px);
}

/* Estilos para os campos do formulário */
form div {
    margin-bottom: 20px;
}

label {
    display: block;
    font-size: 16px;
    color: #333;
    margin-bottom: 5px;
}

input[type="text"] {
    width: 100%;
    padding: 14px;
    font-size: 16px;
    border: 2px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
    transition: border-color 0.3s, box-shadow 0.3s;
}

input[type="text"]:focus {
    outline: none;
    border-color: #007BFF;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Estilos para o botão */
button {
    width: 100%;
    padding: 15px;
    background-color: #007BFF;
    color: #fff;
    border: none;
    font-size: 18px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
}

button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

/* Estilos para a mensagem de status */
.message {
    margin-top: 20px;
    font-size: 16px;
    text-align: center;
    transition: color 0.3s;
}

/* Cores */
.success {
    color: #28a745;
}

.error {
    color: #dc3545;
}

    </style>
</head>
<body>
    <form id="faqForm">
        <div>
            <label for="question">Pergunta:</label>
            <input name="question" type="text" required>
        </div>
        
        <!-- Resposta Oculta -->
        <input name="answer" type="hidden" value="Aguardando resposta">

        <div>
            <button type="submit">Adicionar FAQ</button>
        </div>
    </form>
    <div class="message" id="message"></div>

    <script>
        // Enviar formulário para o servidor
        document.getElementById('faqForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            formData.append('answer', 'Aguardando resposta...'); // Garantir que a resposta seja sempre "Aguardando resposta"

            const response = await fetch(`<?= url("api/faqs/create");?>`, {
                method: 'POST',
                body: formData,
            });

            let result;
            try {
                result = await response.json();
            } catch (error) {
                result = { success: false, message: 'Erro ao processar a solicitação.' };
            }

            const messageDiv = document.getElementById('message');
            if (result.success) {
                messageDiv.textContent = 'FAQ adicionada com sucesso!';
                messageDiv.classList.add('success');
                messageDiv.classList.remove('error');
            } else {
                messageDiv.textContent = result.message || 'Erro ao adicionar FAQ.';
                messageDiv.classList.add('error');
                messageDiv.classList.remove('success');
            }
        });
    </script>
</body>
</html>
