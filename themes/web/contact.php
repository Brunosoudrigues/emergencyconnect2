<?php
    echo $this->layout("_theme");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
    <link rel="stylesheet" href="styles.css">
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
}



nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

section#contato {
    padding: 50px;
    background-color: #f9f9f9;
    text-align: center;
}

h1 {
    margin-bottom: 30px;
}

.form-container {
    max-width: 600px;
    margin: 0 auto;
    background-color: white;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
textarea {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

button {
    padding: 15px;
    border: none;
    background-color: red;
    color: white;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: darkred;
}

    </style>



    <section id="contato">
        <h1>Entre em Contato</h1>
        <div class="form-container">
            <form action="envio.php" method="POST">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Seu nome" required>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Seu e-mail" required>

                <label for="mensagem">Mensagem:</label>
                <textarea id="mensagem" name="mensagem" rows="5" placeholder="Sua mensagem" required></textarea>

                <button type="submit">Enviar</button>
            </form>
        </div>
    </section>
</body>
</html>
