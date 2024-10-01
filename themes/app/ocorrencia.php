<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Ocorrências</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
        }
        h1 {
            color: #dc3545; /* Vermelho do Bootstrap */
            text-align: center;
            margin-bottom: 20px;
        }
        .history {
            margin-top: 20px;
        }
        .history h2 {
            color: #dc3545;
            margin-bottom: 15px;
            font-size: 24px;
        }
        .history ul {
            list-style-type: none;
            padding: 0;
        }
        .history li {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .history .incident-type {
            font-weight: bold;
            color: #dc3545;
        }
        .history .details {
            margin-top: 10px;
            color: #343a40;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Histórico de Ocorrências</h1>
        <div class="history">
            <h2>Ocorrências Registradas</h2>
            <ul>
                <li>
                    <div class="incident-type">Acidente</div>
                    <div class="details">
                    <p><strong>Numero de ocorrencia:</strong>05289249821</p>
                        <p><strong>Local:</strong> Rua das Flores, 123</p>
                        <p><strong>Gravidade:</strong> Moderado</p>
                        <p><strong>Detalhes:</strong> O indivíduo sofreu uma queda e está com ferimentos leves.</p>
                    </div>
                </li>
                <li>
                    <div class="incident-type">Incêndio</div>
                    <div class="details">
                    <p><strong>Numero de ocorrencia:</strong>907807601</p>
                        <p><strong>Local:</strong> Avenida Central, 456</p>
                        <p><strong>Tamanho:</strong> Grande</p>
                        <p><strong>Detalhes:</strong> Incêndio em um prédio comercial. Equipes de combate a incêndio no local.</p>
                    </div>
                </li>
                <li>
                    <div class="incident-type">Envenenamento</div>
                    <div class="details">
                    <p><strong>Numero de ocorrencia:</strong>38075075249821</p>
                        <p><strong>Fonte:</strong> Produtos de limpeza</p>
                        <p><strong>Sintomas:</strong> Náuseas e dificuldade respiratória</p>
                        <p><strong>Detalhes:</strong> A vítima foi exposta a produtos químicos e apresenta sintomas graves.</p>
                    </div>
                </li>
                <li>
                    <div class="incident-type">Afogamento</div>
                    <div class="details">
                        <p><strong>Local:</strong> Piscina Municipal</p>
                        <p><strong>Profundidade:</strong> 2 metros</p>
                        <p><strong>Detalhes:</strong> Vítima resgatada da piscina, consciente mas com dificuldade para respirar.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>
