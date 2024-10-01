<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Privada - Site de Emergência</title>
    <link rel="stylesheet" href="<?= url("assets/css/app/styles.css"); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #FFFFFF; /* Fundo branco */
            color: #FF0000; /* Texto vermelho */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            margin: 0;
            padding: 20px;
            font-size: 36px;
            font-weight: bold;
            color: #FF0000;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
        .button-container {
            margin-top: 30px;
        }
        .button {
            display: inline-flex;
            align-items: center;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            color: #FFFFFF;
            background-color: #FF0000; /* Fundo vermelho */
            border: none;
            border-radius: 8px;
            text-decoration: none;
            margin: 10px;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            gap: 10px; /* Espaçamento entre o ícone e o texto */
        }
        .button:hover {
            background-color: #CC0000; /* Vermelho mais escuro para hover */
            transform: scale(1.05);
        }
        .button:active {
            background-color: #990000; /* Vermelho muito escuro para clique */
            transform: scale(0.95);
        }
        .button i {
            font-size: 24px; /* Tamanho dos ícones */
        }
    </style>
</head>
<body>
    <h1>Site de Emergência</h1>
    <div class="button-container">
        <a href="<?= url("app/perfil"); ?>" class="button"><i class="fas fa-user"></i> Perfil</a>
        <a href="<?= url("app/primeirosocorros"); ?>" class="button"><i class="fas fa-first-aid"></i> Primeiros Socorros</a>
        <a href="<?= url("app/ocorrencias"); ?>" class="button"><i class="fas fa-list"></i> Ocorrências</a>
    </div>
</body>
</html>
