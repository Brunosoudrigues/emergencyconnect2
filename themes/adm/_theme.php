<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - EmergencyConnect</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        header {
            background-color: #d32f2f;
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: space-around;
            background-color: #b71c1c;
            padding: 10px 0;
        }
        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            padding: 20px;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
        }
        .card h2 {
            color: #d32f2f;
        }
        .card p {
            line-height: 1.6;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: #d32f2f;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Área Admin - EmergencyConnect</h1>
</header>

<main>
    <section id="usuarios" class="card">
        <h2>Gerenciar Medicos</h2>
        <p>Aqui você pode visualizar, editar e excluir informações dos usuários cadastrados no sistema.</p>
        <button onclick="acessarUsuarios()" style="background-color: #d32f2f; color: white; border: none; padding: 10px 20px; border-radius: 5px;">Acessar</button>
    </section>

    <section id="emergencias" class="card">
        <h2>Pedidos de Emergência</h2>
        <p>Verifique e gerencie os pedidos de assistência enviados pelos usuários em tempo real.</p>
        <button onclick="acessarEmergencias()" style="background-color: #d32f2f; color: white; border: none; padding: 10px 20px; border-radius: 5px;">Acessar</button>
    </section>

    <section id="conteudo" class="card">
        <h2>Cadastre Medicos</h2>
        <p>Adicione os profissionais responsáveis pela Analise de risco.
        </p>
        <button onclick="acessarConteudo()" style="background-color: #d32f2f; color: white; border: none; padding: 10px 20px; border-radius: 5px;">Acessar</button>
    </section>
</main>

<footer>
    &copy; 2024 EmergencyConnect. Todos os direitos reservados.
</footer>

<script>
    // Função para redirecionar para a página de gerenciamento de usuários
    function acessarUsuarios() {
        window.location.href = '<?php echo url("admin/listMedico"); ?>'; // Usando PHP para gerar a URL
    }

    // Função para redirecionar para a página de pedidos de emergência
    function acessarEmergencias() {
        window.location.href = '<?php echo url("admin/listaocorrencia"); ?>'; // Usando PHP para gerar a URL
    }

    // Função para redirecionar para a página de conteúdo educativo
    function acessarConteudo() {
        window.location.href = '<?php echo url("admin/Medico"); ?>'; // Substitua com o caminho correto
    }
</script>

</body>
</html>
