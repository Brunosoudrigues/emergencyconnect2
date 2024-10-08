<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <style>
        /* Reset de margem e padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #007bff;
        }

        p {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 10px 0; /* Espaçamento entre os botões */
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3; /* Cor mais escura ao passar o mouse */
        }

        .btn-logout {
            background-color: #dc3545; /* Vermelho para o logout */
        }

        .btn-logout:hover {
            background-color: #c82333;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Bem-vinde, <span id="userName"></span>!</h1>
        <p>Email: <span id="userEmail"></span></p>
        <!-- Botões -->
        <a href="<?= url("login"); ?>" class="button btn-logout" onclick="logout()">Sair</a>
        <a href="<?= url("app/primeirosocorros"); ?>" class="button"><i class="fas fa-first-aid"></i> Primeiros Socorros</a>
        <a href="<?= url("app/ocorrencias"); ?>" class="button"><i class="fas fa-list"></i> Ocorrências</a>
        <div class="footer">EmergencyConnect © 2024</div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const user = JSON.parse(localStorage.getItem("userAuth"));

            if (user) {
                document.getElementById("userName").textContent = user.name;
                document.getElementById("userEmail").textContent = user.email;
            } else {
                // Se não houver usuário, redirecionar para a página de login
                window.location.href = "<?= url("login"); ?>";
            }
        });

        function logout() {
            localStorage.removeItem("userAuth");
        }
    </script>
</body>
</html>
