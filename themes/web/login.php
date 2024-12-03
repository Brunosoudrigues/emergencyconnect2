<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script type="module" src="<?= url("assets/js/web/login.js"); ?>" async></script>
    <style>
        /* Estilos básicos para o formulário */
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #cc0000;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #cc0000;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #ff0000;
        }

        button {
            width: 100%;
            background-color: #cc0000;
            color: #fff;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #ff0000;
        }

        .message {
            margin-top: 15px;
            text-align: center;
            color: #cc0000;
            display: none; /* Inicialmente oculto */
            font-size: 18px; /* Aumenta o tamanho da fonte */
        }

        /* Estilo para o botão desabilitado */
        .disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Estilo do temporizador */
        .timer {
            font-size: 18px;
            color: #cc0000;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form id="formLogin">
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Senha" required>
        <button type="submit" id="loginButton">Entrar</button>
    </form>
    <div class="message" id="message"></div> <!-- Elemento para mensagens -->
    <div class="timer" id="timer"></div> <!-- Elemento para o temporizador -->
</div>

<script type="text/javascript">
    const form = document.getElementById('formLogin');
    const loginButton = document.getElementById('loginButton');
    const messageDiv = document.getElementById('message');
    const timerDiv = document.getElementById('timer');
    let attemptCount = 0;
    let lockTime = null;  // Armazena o tempo de bloqueio
    let timerInterval = null;  // Intervalo do temporizador

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Verifica se está bloqueado
        if (lockTime && new Date() < lockTime) {
            const remainingTime = Math.round((lockTime - new Date()) / 1000);
            messageDiv.textContent = `Você está bloqueado. Tente novamente em ${remainingTime} segundos.`;
            messageDiv.style.color = 'red';
            messageDiv.style.display = 'block';
            showTimer(remainingTime); // Exibe o temporizador
            return;
        }

        const email = form.email.value;
        const password = form.password.value;

        // Aqui você pode adicionar a lógica de validação da senha (simulando um erro de login)
        const isValidLogin = (email === "test@example.com" && password === "Senha123!");

        if (isValidLogin) {
            messageDiv.textContent = "Login bem-sucedido!";
            messageDiv.style.color = 'green';
            messageDiv.style.display = 'block';
            attemptCount = 0; // Resetar contador após sucesso
            // Redirecionar ou continuar o processo de login
        } else {
            attemptCount++;
            if (attemptCount >= 3) {
                lockTime = new Date(new Date().getTime() + 1 * 60 * 1000); // Bloquear por 1 minuto
                loginButton.classList.add('disabled');
                loginButton.disabled = true;

                messageDiv.textContent = "Você tentou muitas vezes. Tente novamente em 1 minuto.";
                messageDiv.style.color = 'red';
                messageDiv.style.display = 'block';

                // Inicia o temporizador
                startTimer();
            } else {
                messageDiv.textContent = "E-mail ou senha incorretos!";
                messageDiv.style.color = 'red';
                messageDiv.style.display = 'block';
            }
        }
    });

    // Função para iniciar o temporizador
    function startTimer() {
        const endTime = new Date(new Date().getTime() + 1 * 60 * 1000); // 1 minuto
        timerInterval = setInterval(() => {
            const remainingTime = Math.round((endTime - new Date()) / 1000);
            if (remainingTime <= 0) {
                clearInterval(timerInterval); // Para o temporizador
                loginButton.classList.remove('disabled');
                loginButton.disabled = false;
                messageDiv.textContent = "Agora você pode tentar novamente.";
                messageDiv.style.color = 'green';
                messageDiv.style.display = 'block';
                timerDiv.textContent = ''; // Limpa o temporizador
            } else {
                showTimer(remainingTime); // Atualiza o temporizador
            }
        }, 1000); // Atualiza a cada segundo
    }

    // Função para exibir o temporizador na tela
    function showTimer(remainingTime) {
        const minutes = Math.floor(remainingTime / 60);
        const seconds = remainingTime % 60;
        timerDiv.textContent = `Tempo restante: ${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
    }
</script>

</body>
</html>
