<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar FAQs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #555;
        }

        #faqTable {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
        }

        #faqTable th, #faqTable td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        #faqTable th {
            background-color: #007BFF;
            color: white;
        }

        #faqTable tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        #faqTable tr:hover {
            background-color: #f1f1f1;
        }

        #faqTable td a {
            color: #007BFF;
            text-decoration: none;
        }

        #faqTable td a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Gerenciar FAQs</h1>
    <table id="faqTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pergunta</th>
                <th>Resposta</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- As FAQs serão carregadas aqui via JavaScript -->
        </tbody>
    </table>

    <script>
        function loadFaqs() {
            fetch('http://localhost/emergencyconnect2/api/faqs/list')
                .then(response => response.json())
                .then(data => {
                    if (data.type === 'success' && data.data) {
                        const faqs = data.data;
                        const tbody = document.querySelector('#faqTable tbody');
                        tbody.innerHTML = '';  // Limpa o conteúdo da tabela antes de adicionar novos dados

                        faqs.forEach(faq => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${faq.id}</td>
                                <td>${faq.question}</td>
                                <td>${faq.answer}</td>
                                <td><a href="http://localhost/emergencyconnect2/admin/updatefaq?id=${faq.id}">Editar</a></td>
                            `;
                            tbody.appendChild(row);
                        });
                    } else {
                        alert('Erro ao carregar FAQs');
                    }
                })
                .catch(error => {
                    console.error('Erro na requisição:', error);
                    alert('Erro ao carregar FAQs');
                });
        }

        window.onload = loadFaqs;
    </script>
</body>
</html>
