<?php

use Source\Models\Faq\Question;

// Inicializa o ID da FAQ
$faqId = $_GET['id'] ?? null;
$faqData = null;

// Se o ID da FAQ foi passado, tenta buscar os dados da FAQ
if ($faqId) {
    $faqData = (new Question())->selectById($faqId);
} else {
    echo json_encode(['success' => false, 'message' => 'ID da FAQ não fornecido.']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar FAQ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .update-container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .update-container input, 
        .update-container textarea, 
        .update-container button {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .update-container button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            border: none;
        }

        .update-container button:hover {
            background-color: #218838;
        }

        .message {
            margin-top: 15px;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="update-container">
    <h2>Atualizar FAQ</h2>
    <form id="updateFaqForm">
        <input type="hidden" id="faqIdInput" value="<?= htmlspecialchars($faqId) ?>" required>

        <?php if ($faqData): ?>
            <label for="question">Pergunta:</label>
            <input type="text" id="question" value="<?= htmlspecialchars($faqData->getQuestion()) ?>" required>

            <label for="answer">Resposta:</label>
            <textarea id="answer" required><?= htmlspecialchars($faqData->getAnswer()) ?></textarea>

            <button type="submit">Atualizar FAQ</button>
        <?php else: ?>
            <p class="message">Por favor, insira um ID de FAQ válido para editar.</p>
        <?php endif; ?>
    </form>
    <div id="message" class="message"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#updateFaqForm').submit(function(event) {
        event.preventDefault();

        const faqId = $('#faqIdInput').val();
        const question = $('#question').val();
        const answer = $('#answer').val();
        $.ajax({
    url: `http://localhost/emergencyconnect2/api/faqs/update/${faqId}`, // URL correta com o ID
    type: 'POST', // Certifique-se de que o método seja POST
    contentType: 'application/json',
    data: JSON.stringify({
        question: question,
        answer: answer
    }),
    success: function(response) {
        alert(response.message || 'FAQ atualizada com sucesso!');
    },
    error: function(xhr) {
        console.error('Erro na requisição:', xhr.responseText);
        alert('Erro na requisição.');
    }
});


    });
});
</script>

</body>
</html>
