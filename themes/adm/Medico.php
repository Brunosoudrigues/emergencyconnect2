<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Médico</title>
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
            height: 160vh;
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
            overflow-y: auto;  /* Permite rolagem se necessário */
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

        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, select:focus {
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
    <form id="medicoForm">
        <div>
            <label for="nome">Nome Completo:</label>
            <input name="nome" type="text" required>
        </div>
        <div>
            <label for="email">E-mail:</label>
            <input name="email" type="email" required>
        </div>
        <div>
            <label for="crm">CRM:</label>
            <input name="crm" type="text" required>
        </div>
        <div>
            <label for="especialidade">Especialidade:</label>
            <input name="especialidade" type="text" required>
        </div>
        <div>
            <label for="telefone">Telefone:</label>
            <input name="telefone" type="text" required>
        </div>
        <div>
            <label for="endereco">Endereço:</label>
            <input name="endereco" type="text" required>
        </div>
        <div>
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" required>
                <option value="">Selecione o Estado</option>
                <!-- Estados serão carregados aqui -->
            </select>
        </div>
        <div>
            <label for="cidade">Cidade:</label>
            <select name="cidade" id="cidade" required>
                <option value="">Selecione a Cidade</option>
                <!-- Cidades serão carregadas aqui -->
            </select>
        </div>
        <div>
            <label for="status">Status:</label>
            <input name="status" type="text" required>
        </div>
        <div>
            <button type="submit">Cadastrar Médico</button>
        </div>
    </form>
    <div class="message" id="message"></div>

    <script>
        // Carregar estados no select
        fetch('https://br-cidade-estado-node.glitch.me/estados')
            .then(response => response.json())
            .then(estados => {
                let estadoSelect = document.getElementById('estado');
                estados.forEach(estado => {
                    let option = document.createElement('option');
                    option.value = estado.id;
                    option.textContent = estado.estado;
                    estadoSelect.appendChild(option);
                });
            });

        // Carregar cidades ao selecionar o estado
        document.getElementById('estado').addEventListener('change', function() {
            let uf = this.value;
            fetch(`https://br-cidade-estado-node.glitch.me/estados/${uf}/cidades`)
                .then(response => response.json())
                .then(data => {
                    let cidadeSelect = document.getElementById('cidade');
                    cidadeSelect.innerHTML = ''; // Limpa as opções anteriores
                    data.cidades.forEach(cidade => {
                        let option = document.createElement('option');
                        option.value = cidade.cidade;
                        option.textContent = cidade.cidade;
                        cidadeSelect.appendChild(option);
                    });
                });
        });

        // Enviar formulário para o servidor
        document.getElementById('medicoForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const response = await fetch(`<?= url("api/medicos");?>`, {
                method: 'POST',
                body: new FormData(e.target),
            });

            let result;
            try {
                result = await response.json();
            } catch (error) {
                result = { success: false, message: 'Erro ao processar a solicitação.' };
            }

            const messageDiv = document.getElementById('message');
            if (result.success) {
                messageDiv.textContent = 'Médico cadastrado com sucesso!';
                messageDiv.classList.add('success');
                messageDiv.classList.remove('error');
            } else {
                messageDiv.textContent = result.message || 'Erro ao cadastrar médico.';
                messageDiv.classList.add('error');
                messageDiv.classList.remove('success');
            }
        });
    </script>
</body>
</html>
