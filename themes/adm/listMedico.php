<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Todos os Médicos</title>

    <!-- CSS Embutido para Estilo -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        button {
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            display: block;
            margin: 20px auto;
        }

        button:hover {
            background-color: #0056b3;
        }

        #result {
            margin-top: 20px;
        }

        .medico {
            background-color: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .medico h3 {
            margin-top: 0;
            color: #333;
        }

        .details {
            margin-top: 10px;
        }

        .details p {
            font-size: 14px;
            color: #555;
        }

        .details strong {
            color: #333;
        }
    </style>
</head>
<body>

    <h1>Consultar Todos os Médicos</h1>

    <button onclick="getAllMedicos()">Consultar Todos os Médicos</button>

    <div id="result"></div>

    <script>
        async function getAllMedicos() {
            // Fazer a requisição GET para a API que retorna todos os médicos
            const response = await fetch('http://localhost/emergencyconnect2/api/medicos/list');
            const data = await response.json();

            // Exibir os resultados
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = '';  // Limpar resultados anteriores

            // Verificar se a resposta foi bem-sucedida
            if (data.type === 'success' && data.data.length > 0) {
                const medicos = data.data;
                medicos.forEach(medico => {
                    let html = `
                        <div class="medico">
                            <h3>Médico ID: ${medico.id}</h3>
                            <div class="details">
                                <p><strong>Nome:</strong> ${medico.nome}</p>
                                <p><strong>CRM:</strong> ${medico.crm}</p>
                                <p><strong>Especialidade:</strong> ${medico.especialidade}</p>
                                <p><strong>Email:</strong> ${medico.email}</p>
                                <p><strong>Telefone:</strong> ${medico.telefone}</p>
                                <p><strong>Endereço:</strong> ${medico.endereco}</p>
                                <p><strong>Cidade:</strong> ${medico.cidade}</p>
                                <p><strong>Estado:</strong> ${medico.estado}</p>
                                <p><strong>Status:</strong> ${medico.status}</p>
                            </div>
                        </div>
                    `;
                    resultDiv.innerHTML += html;
                });
            } else {
                resultDiv.innerHTML = `<p>Não foram encontrados médicos.</p>`;
            }
        }
    </script>

</body>
</html>
