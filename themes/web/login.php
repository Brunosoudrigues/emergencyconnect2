<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href=""> <!-- Link para o arquivo CSS, se houver -->
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
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form id="formLogin">
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Senha" required>
        <button type="submit">Entrar.....</button>
    </form>
    <div class="message" id="message"></div> <!-- Elemento para mensagens -->
</div>

</body>
</html>
