<?php
    echo $this->layout("_theme");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localização</title>
    <link rel="stylesheet" href="styles.css">
</head>
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

section#localizacao {
    text-align: center;
    padding: 50px;
    background-color: #f9f9f9;
}

h1 {
    margin-bottom: 30px;
}

#mapa-container {
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

    </style>

<body>
    
   

    <section id="localizacao">
        <h1>Nos encontre aqui!</h1>
        <div id="mapa-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345093747!2d144.96305791568506!3d-37.813627742021554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d43f2f89d7b%3A0x5045675218ce7e0!2sMelbourne%2C%20Austr%C3%A1lia!5e0!3m2!1spt-BR!2sbr!4v1695049854377!5m2!1spt-BR!2sbr" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

</body>
</html>

