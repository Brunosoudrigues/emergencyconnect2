<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Ocorrências</title>

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

        label {
            font-size: 16px;
            margin-right: 10px;
        }

        input {
            padding: 8px;
            font-size: 14px;
            width: 200px;
            margin-right: 10px;
        }

        button {
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }

        #result {
            margin-top: 20px;
        }

        .occurrence {
            background-color: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .occurrence h3 {
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

    <!-- Incluir a biblioteca jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>

    <h1>Consultar Ocorrências</h1>

    <label for="cpf">Digite seu CPF:</label>
    <input type="text" id="cpf" name="cpf" placeholder="CPF (somente números)" required>
    <button onclick="getOccurrences()">Consultar</button>
    <button onclick="generatePDF()">Gerar Relatório em PDF</button>

    <div id="result"></div>

    <script>
        let occurrencesData = [];  // Variável global para armazenar as ocorrências

        async function getOccurrences() {
            const cpf = document.getElementById('cpf').value;

            // Verificar se o CPF tem 11 caracteres
            if (cpf.length !== 11 || isNaN(cpf)) {
                alert('CPF inválido! O CPF deve ter 11 números.');
                return;
            }

            // Fazer a requisição GET para a API
            const response = await fetch(`http://localhost/emergencyconnect2/api/emergencyForms/occurrences/${cpf}`);
            const data = await response.json();

            // Exibir os resultados
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = '';  // Limpar resultados anteriores

            // Verificar se a resposta foi bem-sucedida
            if (data.type === 'success' && data.data.length > 0) {
                occurrencesData = data.data;  // Armazenar dados das ocorrências
                occurrencesData.forEach(occurrence => {
                    let html = `
                        <div class="occurrence">
                            <h3>Ocorrência ID: ${occurrence.id}</h3>
                            <div class="details">
                                <p><strong>CPF:</strong> ${occurrence.cpf}</p>
                                <p><strong>Tipo de Incidente:</strong> ${occurrence.typeOfIncident}</p>
                                <p><strong>Condição de Saúde:</strong> ${occurrence.healthCondition}</p>
                                <p><strong>Endereço:</strong> ${occurrence.address}</p>
                                <p><strong>Local da Dor:</strong> ${occurrence.painLocation || 'Não informado'}</p>
                                <p><strong>Respiração:</strong> ${occurrence.breathing || 'Não informado'}</p>
                                <p><strong>Consciência:</strong> ${occurrence.consciousness || 'Não informado'}</p>
                                <p><strong>Lesões:</strong> ${occurrence.injuries || 'Não informado'}</p>
                                <p><strong>Alergias:</strong> ${occurrence.allergies || 'Não informado'}</p>
                                <p><strong>Medicações:</strong> ${occurrence.medications || 'Não informado'}</p>
                                <p><strong>Contato de Emergência:</strong> ${occurrence.emergencyContact}</p>
                            </div>
                        </div>
                    `;
                    resultDiv.innerHTML += html;
                });
            } else {
                resultDiv.innerHTML = `<p>Não foram encontradas ocorrências para este CPF.</p>`;
            }
        }

        // Função para gerar o relatório em PDF
        function generatePDF() {
            if (occurrencesData.length === 0) {
                alert('Nenhuma ocorrência encontrada para gerar o relatório.');
                return;
            }

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Título
            doc.setFontSize(18);
            doc.text('Relatório de Ocorrências', 20, 20);
            doc.setFontSize(12);

            let yPosition = 30; // Posição inicial do conteúdo

            occurrencesData.forEach((occurrence, index) => {
                if (yPosition > 250) {
                    doc.addPage();  // Adiciona uma nova página se o conteúdo ultrapassar a posição
                    yPosition = 20;  // Reseta a posição para o início da nova página
                }

                doc.text(`Ocorrência ID: ${occurrence.id}`, 20, yPosition);
                yPosition += 10;
                doc.text(`CPF: ${occurrence.cpf}`, 20, yPosition);
                yPosition += 10;
                doc.text(`Tipo de Incidente: ${occurrence.typeOfIncident}`, 20, yPosition);
                yPosition += 10;
                doc.text(`Condição de Saúde: ${occurrence.healthCondition}`, 20, yPosition);
                yPosition += 10;
                doc.text(`Endereço: ${occurrence.address}`, 20, yPosition);
                yPosition += 10;
                doc.text(`Local da Dor: ${occurrence.painLocation || 'Não informado'}`, 20, yPosition);
                yPosition += 10;
                doc.text(`Respiração: ${occurrence.breathing || 'Não informado'}`, 20, yPosition);
                yPosition += 10;
                doc.text(`Consciência: ${occurrence.consciousness || 'Não informado'}`, 20, yPosition);
                yPosition += 10;
                doc.text(`Lesões: ${occurrence.injuries || 'Não informado'}`, 20, yPosition);
                yPosition += 10;
                doc.text(`Alergias: ${occurrence.allergies || 'Não informado'}`, 20, yPosition);
                yPosition += 10;
                doc.text(`Medicações: ${occurrence.medications || 'Não informado'}`, 20, yPosition);
                yPosition += 10;
                doc.text(`Contato de Emergência: ${occurrence.emergencyContact}`, 20, yPosition);
                yPosition += 20;  // Espaço após a ocorrência

                // Adiciona uma linha de separação entre as ocorrências
                doc.line(20, yPosition, 190, yPosition);
                yPosition += 10;
            });

            // Salvar o PDF
            doc.save('relatorio_ocorrencias.pdf');
        }
    </script>

</body>
</html>
