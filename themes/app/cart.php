

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Primeiros Socorros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
        }
        h1 {
            color: #dc3545; /* Vermelho do Bootstrap */
            text-align: center;
            margin-bottom: 20px;
        }
        .question {
            display: none;
        }
        .question.active {
            display: block;
        }
        .question label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .question input, .question select {
            width: calc(100% - 22px); /* Ajuste do padding */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }
        button {
            background-color: #dc3545; /* Vermelho do Bootstrap */
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #c82333;
        }
        button:disabled {
            background-color: #6c757d;
        }
        .message {
            margin-top: 20px;
            color: #28a745; /* Verde do Bootstrap */
            text-align: center;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button-container button {
            flex: 1;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulário de Primeiros Socorros</h1>
        <form id="firstAidForm">
            <div id="question1" class="question active">
                <label for="healthCondition">Qual é o estado de saúde da pessoa?</label>
                <input type="text" id="healthCondition" name="healthCondition" required>
            </div>
            <div id="question2" class="question">
                <label for="typeOfIncident">Qual é o tipo de ocorrência?</label>
                <input type="text" id="typeOfIncident" name="typeOfIncident" required>
            </div>
            <div id="question3" class="question">
                <label for="address">Qual é o endereço da ocorrência?</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div id="question4" class="question">
                <label for="painLocation">Onde a pessoa está sentindo dor?</label>
                <input type="text" id="painLocation" name="painLocation" required>
            </div>
            <div id="question5" class="question">
                <label for="breathing">A pessoa está respirando normalmente?</label>
                <select id="breathing" name="breathing" required>
                    <option value="yes">Sim</option>
                    <option value="no">Não</option>
                </select>
            </div>
            <div id="question6" class="question">
                <label for="consciousness">A pessoa está consciente?</label>
                <select id="consciousness" name="consciousness" required>
                    <option value="yes">Sim</option>
                    <option value="no">Não</option>
                </select>
            </div>
            <div id="question7" class="question">
                <label for="injuries">Há ferimentos visíveis?</label>
                <select id="injuries" name="injuries" required>
                    <option value="yes">Sim</option>
                    <option value="no">Não</option>
                </select>
            </div>
            <div id="question8" class="question">
                <label for="allergies">A pessoa tem alergias conhecidas?</label>
                <input type="text" id="allergies" name="allergies">
            </div>
            <div id="question9" class="question">
                <label for="medications">A pessoa está tomando algum medicamento?</label>
                <input type="text" id="medications" name="medications">
            </div>
            <div id="question10" class="question">
                <label for="emergencyContact">Qual é o contato de emergência?</label>
                <input type="text" id="emergencyContact" name="emergencyContact">
            </div>
            <div class="message" id="message"></div>
            <div class="button-container">
                <button type="button" id="prevButton" disabled>Anterior</button>
                <button type="button" id="nextButton">Próximo</button>
            </div>
        </form>
    </div>

    <script>
        const questions = document.querySelectorAll('.question');
        let currentQuestionIndex = 0;
        const nextButton = document.getElementById('nextButton');
        const prevButton = document.getElementById('prevButton');
        const message = document.getElementById('message');

        function showQuestion(index) {
            questions.forEach((question, i) => {
                question.classList.toggle('active', i === index);
            });
            nextButton.textContent = index === questions.length - 1 ? 'Enviar' : 'Próximo';
            prevButton.disabled = index === 0;
        }

        function handleFormSubmission() {
            // Aqui você pode adicionar a lógica para processar ou enviar os dados
            message.textContent = 'Formulário enviado com sucesso!';
        }

        nextButton.addEventListener('click', () => {
            if (currentQuestionIndex < questions.length - 1) {
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
            } else {
                handleFormSubmission();
            }
        });

        prevButton.addEventListener('click', () => {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                showQuestion(currentQuestionIndex);
            }
        });

        showQuestion(currentQuestionIndex); // Inicializa o formulário com a primeira pergunta
    </script>
</body>
</html>
