<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= url("assets/css/web/styles.css"); ?>">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script> <!-- Inclusão do html2pdf -->

    
</head>
<body>
    <header>
        <nav id="navbar">
            <i class="" id="nav_logo"> EmergencyConnect</i>
            <ul id="nav_list">
                <li class="nav-item active">
                    <a href="<?= url();?>">Home</a>
                    <a href="<?= url("sobre"); ?>">Sobre</a>
                    <a href="<?= url("contato"); ?>">Contato</a>
                    <a href="<?= url("localizacao"); ?>">Localização</a>
                    <a href="<?= url("faqs"); ?>">FAQs</a>
                    <a href="<?= url("register"); ?>">Cadastro</a>
                    <a href="<?= url("login"); ?>">Entrar</a>
                </li>
            </ul>
            <button id="mobile_btn">
                <i class="fa-solid fa-bars"></i>
            </button>
        </nav>
    </header>

    <?php
        echo $this->section("content");
    ?>
    <main id="content">
        <section id="home">
            <div class="shape"></div>
            <div id="cta">
                <h1 class="title">
                    Segurança rápida e 
                    <span>educativa</span>
                </h1>
                <p class="description">
                    EmergencyConnect conecta alunos a serviços de emergência rapidamente e oferece educação sobre primeiros socorros.
                </p>
                
                <!-- Botão para gerar o PDF -->
             <h1>   <button id="generate_pdf">Gerar Guia de Primeiros Socorros</button> <h1>

                <div class="social-media-buttons">
                    <a href="">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <a href="">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                </div>
            </div>
        </section>

        <section id="menu">
            <h2 class="section-title">SERVIÇOS DISPONIVEIS</h2>
            <div id="dishes">
                <div class="dish">
                    <div class="dish-heart">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <h3 class="dish-title">
                    Polícia
                    </h3>
                    <img src="<?= url("./assets/css/web/policia.png")?>" class="dish-image" alt="">

                    <span class="dish-description">
                    Para crimes, violência, furtos e situações de perigo.
                    </span>

                    <div class="dish-rate">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span>(1000+)</span>
                    </div>

                    <div class="dish-price">
                    </div>
                </div>

                <div class="dish">
                    <div class="dish-heart">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                    <h3 class="dish-title">
                    Bombeiros
                    </h3>

                    <img src="<?= url("./assets/css/web/bombeiro.png")?>" class="dish-image" alt="">

                    <span class="dish-description">
                    Para incêndios, acidentes, resgates e desastres naturais
                    </span>

                    <div class="dish-rate">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span>(500+)</span>
                    </div>

                    <div class="dish-price">
                    </div>
                </div>

                <div class="dish">
                    <div class="dish-heart">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <img src="<?= url("./assets/css/web/ambulancia.png")?>" class="dish-image" alt="">

                    <h3 class="dish-title">
                    Ambulância
                    </h3>

                    <span class="dish-description">
                    Para emergências médicas, como infartos, acidentes graves e crises respiratórias.
                    </span>

                    <div class="dish-rate">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span>(500+)</span>
                    </div>

                    <div class="dish-price">
                    </div>
                </div>

            </div>
        </section>

        <section id="testimonials">
            <img src="src/images/chef.png" id="testimonial_chef" alt="">

            <div id="testimonials_content">
                <h2 class="section-title">
                    Depoimentos
                </h2>
                <h3 class="section-subtitle">
                    O que os usuários falam sobre nós:
                </h3>

                <div id="feedbacks">
                    <div class="feedback">
                        <img src="<?= url("./assets/css/web/cara.png")?>" class="dish-image" alt="">

                        <div class="feedback-content">
                            <p>
                          <b>Joao Pedro</b>
                                <span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            </p>
                            <p>
                            Durante um intervalo na escola, João percebeu uma situação de agressão entre colegas. Usando o EmergencyConnect, ele acionou a polícia com rapidez, garantindo a chegada das autoridades para controlar a situação e assegurar a segurança dos envolvidos.
                            </p>
                        </div>
                    </div>

                    <div class="feedback">
                    <img src="<?= url("./assets/css/web/mulher.png")?>" class="dish-image" alt="">

                        <div class="feedback-content">
                            <p>
                            <b>Ana Beatriz</b>
                                <span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            </p>
                            <p>
                            Com poucos cliques, ela acionou o EmergencyConnect, que enviou imediatamente uma ambulância para o local. Enquanto aguardava, Ana usou o recurso educativo do aplicativo para aplicar primeiros socorros até a chegada da equipe médica.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <footer>
        <img src="src/images/wave.svg" alt="">
        <div id="footer_items">
            <span id="copyright">End-to-end encryption 2024</span>
            <div class="social-media-buttons">
                <a href="<?= url("/app"); ?>">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </div>
        </div>
    </footer>

    <script>
        // Função que será executada ao clicar no botão
        document.getElementById('generate_pdf').addEventListener('click', function() {
            // Criação do conteúdo do PDF
            var element = document.createElement('div');
            element.innerHTML = `
                <h1>Guia de Primeiros Socorros</h1>
                <h2>1. Identifique a Situação</h2>
                <p>Verifique a gravidade do acidente e a segurança do local.</p>
                <h2>2. Acione o Serviço de Emergência</h2>
                <p>Se necessário, ligue para a polícia, bombeiros ou ambulância.</p>
                <h2>3. Realize os Primeiros Socorros</h2>
                <p>Utilize técnicas básicas de primeiros socorros, como compressão em casos de hemorragia.</p>
                <h2>4. Acompanhe a Situação</h2>
                <p>Continue monitorando a vítima até a chegada dos profissionais.</p>
                <br>
               <p> <h4>Bruno Rodrigues CREMERS 2552<h4></p>
               <p> <h4>Laura Leal CREMERS 36924<h4></p>

            `;

            // Opções de configuração para o PDF
            var opt = {
                margin: 1,
                filename: 'Guia_de_Primeiros_Socorros.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            // Geração e download do PDF
            html2pdf().from(element).set(opt).save();
        });
    </script>
</body>
</html>
