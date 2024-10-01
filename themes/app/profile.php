<!-- perfil.html -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
</head>
<body>
    <h1>Perfil de <span id="userName"></span></h1>
    <p>Email: <span id="userEmail"></span></p>
    <p>Data de Criação: <span id="userCreatedAt"></span></p>
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const user = JSON.parse(localStorage.getItem("userAuth"));

            if (user) {
                document.getElementById("userName").textContent = user.name;
                document.getElementById("userEmail").textContent = user.email;
                document.getElementById("userCreatedAt").textContent = new Date(user.createdAt).toLocaleDateString();
            } else {
                // Se não houver usuário, redirecionar para a página de login
                window.location.href = "/login.html";
            }
        });
    </script>
</body>
</html>
