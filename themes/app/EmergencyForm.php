<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Emergência</title>
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container do formulário */
        form {
            background-color: #fff;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        form:hover {
            transform: translateY(-5px);
        }

        /* Estilos para os campos do formulário */
        form div {
            margin-bottom: 20px;
            display: none; /* Inicialmente oculto */
        }

        input[type="text"], input[type="password"], input[type="number"], textarea {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 2px solid #cc0000;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="password"]:focus, input[type="number"]:focus, textarea:focus {
            outline: none;
            border-color: #ff0000;
            box-shadow: 0 0 5px rgba(204, 0, 0, 0.5);
        }

        /* Estilos para o botão */
        button {
            width: 100%;
            background-color: #cc0000;
            color: #fff;
            border: none;
            padding: 15px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #ff0000;
            transform: translateY(-2px);
        }

        /* Estilos para rótulos */
        label {
            font-size: 16px;
            color: #cc0000;
            font-weight: bold;
        }

        /* Estilo para a mensagem de status */
        .message {
            margin-top: 20px;
            font-size: 16px;
            text-align: center;
            transition: color 0.3s;
        }
    </style>
</head>
<body>

    <form id="emergencyForm">
        <div id="question1">
            <label for="cpf">CPF:</label>
            <input id="cpf" name="cpf" type="text" required>
            <button type="button" onclick="nextQuestion(2)">Próxima</button>
        </div>
        <div id="question2">
            <label for="healthCondition">Condição de Saúde:</label>
            <input id="healthCondition" name="healthCondition" type="text" required>
            <button type="button" onclick="nextQuestion(3)">Próxima</button>
        </div>
        <div id="question3">
            <label for="typeOfIncident">Tipo de Ocorrência:</label>
            <input id="typeOfIncident" name="typeOfIncident" type="text" required>
            <button type="button" onclick="nextQuestion(4)">Próxima</button>
        </div>
        <div id="question4">
            <label for="address">Endereço:</label>
            <input id="address" name="address" type="text">
            <button type="button" onclick="nextQuestion(5)">Próxima</button>
        </div>
        <div id="question5">
            <label for="painLocation">Localização da Dor:</label>
            <input id="painLocation" name="painLocation" type="text">
            <button type="button" onclick="nextQuestion(6)">Próxima</button>
        </div>
        <div id="question6">
            <label for="breathing">Respiração:</label>
            <input id="breathing" name="breathing" type="text">
            <button type="button" onclick="nextQuestion(7)">Próxima</button>
        </div>
        <div id="question7">
            <label for="consciousness">Consciência:</label>
            <input id="consciousness" name="consciousness" type="text">
            <button type="button" onclick="nextQuestion(8)">Próxima</button>
        </div>
        <div id="question8">
            <label for="injuries">Lesões:</label>
            <input id="injuries" name="injuries" type="text">
            <button type="button" onclick="nextQuestion(9)">Próxima</button>
        </div>
        <div id="question9">
            <label for="allergies">Alergias:</label>
            <input id="allergies" name="allergies" type="text">
            <button type="button" onclick="nextQuestion(10)">Próxima</button>
        </div>
        <div id="question10">
            <label for="medications">Medicações:</label>
            <input id="medications" name="medications" type="text">
            <button type="button" onclick="nextQuestion(11)">Próxima</button>
        </div>
        <div id="question11">
            <label for="emergencyContact">Contato de Emergência:</label>
            <input id="emergencyContact" name="emergencyContact" type="text">
            <button type="submit">Enviar</button>
        </div>
    </form>

    <div class="message" id="message"></div>

    <script>
        let currentQuestion = 1;
        const totalQuestions = 11;

        // Função para avançar para a próxima pergunta
        function nextQuestion(questionNumber) {
            // Esconde a pergunta atual
            document.getElementById(`question${currentQuestion}`).style.display = 'none';
            // Exibe a próxima pergunta
            document.getElementById(`question${questionNumber}`).style.display = 'block';
            // Atualiza o número da pergunta atual
            currentQuestion = questionNumber;
        }

        // Inicializa o formulário mostrando a primeira pergunta
        nextQuestion(1);

        // Submete o formulário
        const form = document.getElementById("emergencyForm");
        const messageDiv = document.getElementById("message");

        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const response = await fetch(`<?= url("api/emergencyForms");?>`, {
                method: 'POST',
                body: formData
            });

            let result;
            try {
                result = await response.json();
            } catch (error) {
                result = { success: false, message: "Erro ao processar a requisição." };
            }

            if (result.success) {
                messageDiv.textContent = result.message || "Cadastro realizado com sucesso!";
                messageDiv.style.color = "green";
            } else {
                messageDiv.textContent = result.message || "Erro ao cadastrar. Tente novamente.";
                messageDiv.style.color = "red";
            }
        });
    </script>

</body>
</html>
