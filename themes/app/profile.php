<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <style>
        body {
            background-color: #FFFFFF; /* Fundo branco */
            color: #FF0000; /* Texto vermelho */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .private-area {
            background-color: #FFFAFA; /* Fundo branco com leve tom de rosa */
            color: #FF0000; /* Texto vermelho */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            box-sizing: border-box;
        }
        h1 {
            margin: 0;
            padding-bottom: 20px;
            font-size: 28px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #FF0000;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            background-color: #FF0000; /* Fundo vermelho */
            color: #FFFFFF; /* Texto branco */
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 10px;
        }
        button:hover {
            background-color: #CC0000; /* Vermelho mais escuro para hover */
            transform: scale(1.05);
        }
        button:active {
            background-color: #990000; /* Vermelho muito escuro para clique */
            transform: scale(0.95);
        }
    </style>
</head>
<body>
    <div class="private-area">
        <h1>Perfil do Usuário</h1>
        <form enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Endereço:</label>
                <input type="text" id="address" name="address">
            </div>
            <div class="form-group">
                <label for="photo">Foto:</label>
                <input type="file" id="photo" name="photo" accept="image/*">
            </div>
            <button type="submit">Atualizar Perfil</button>
        </form>
    </div>
</body>
</html>
