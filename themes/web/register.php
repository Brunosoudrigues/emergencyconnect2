<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
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
            max-width: 400px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        form:hover {
            transform: translateY(-5px);
        }

        /* Estilos para os campos do formulário */
        form div {
            margin-bottom: 25px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            border: 2px solid #cc0000;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="password"]:focus {
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

        /* Estilos para os rótulos dos campos */
        div {
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
    <form>
        <div>
            Nome: <input name="name" type="text" required>
        </div>
        <div>
            E-mail: <input name="email" type="text" required>
        </div>
        <div>
            Senha: <input name="password" type="password" required>
        </div>
        <div>
            <button type="submit">Enviar</button>
        </div>
    </form>
    <div class="message" id="message"></div> <!-- Elemento para mensagens -->
    <script type="text/javascript" async>
        const form = document.querySelector("form");
        const messageDiv = document.getElementById("message");

        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            
            const response = await fetch(`<?= url("api/user");?>`, {
                method: "POST",
                body: new FormData(form),
            });

            // Tenta converter a resposta para JSON
            let user;
            try {
                user = await response.json(); // Converte a resposta para JSON
            } catch (error) {
                user = { success: true, message: "Cadastrado com Sucesso" };
            }

            // Verifica o resultado e exibe a mensagem
            if (user.success) {
                messageDiv.textContent = "Cadastro feito com sucesso!";
                messageDiv.style.color = "green"; // Cor verde para sucesso
            } else {
                // Se houver uma mensagem personalizada na resposta
                messageDiv.textContent = user.message || "Erro ao fazer login. Verifique suas credenciais.";
                messageDiv.style.color = "red"; // Cor vermelha para erro
            }

            // Para depuração, mostra a resposta no console
            console.log(user);
        });
    </script>
</body>
</html>
