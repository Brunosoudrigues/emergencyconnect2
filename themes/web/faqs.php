<?php
    echo $this->layout("_theme");
?>
<?php
    $this->start("specific-script");
?>
<script src="<?= url("assets/js/web/faqs.js"); ?>"></script>
<?php
    $this->end();
?>

<!-- Estilos embutidos diretamente no arquivo -->
<style>
    /* Reset básico */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 20px;
    }

    /* Estilo para a seção de FAQ */
    .faq {
        background-color: #ffffff;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .faq:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    /* Pergunta da FAQ */
    .faq-question {
        padding: 20px;
        font-size: 18px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
        background-color: #f8f8f8;
        border-bottom: 1px solid #ddd;
        margin: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .faq-question::after {
        content: "+";
        font-size: 24px;
        color: #555;
        transition: transform 0.3s ease;
    }

    .faq.active .faq-question::after {
        transform: rotate(45deg);
    }

    /* Resposta da FAQ */
    .faq-answer {
        padding: 20px;
        font-size: 16px;
        line-height: 1.5;
        color: #555;
        display: none;
    }

    .faq.active .faq-answer {
        display: block;
    }

    /* Estilo adicional para melhor usabilidade em dispositivos móveis */
    @media (max-width: 768px) {
        .faq-question {
            font-size: 16px;
        }
        
        .faq-answer {
            font-size: 14px;
        }
    }
</style>

<!-- Script embutido diretamente no arquivo -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Seleciona todas as perguntas da FAQ
        const faqQuestions = document.querySelectorAll(".faq-question");

        // Adiciona um evento de clique a cada pergunta
        faqQuestions.forEach(question => {
            question.addEventListener("click", () => {
                // Alterna a classe 'active' para mostrar/ocultar a resposta
                const faq = question.parentElement;
                faq.classList.toggle("active");
            });
        });
    });
</script>

<?php
    foreach ($questions as $question):
?>
    <div class="faq">
        <h1 class="faq-question"><?= $question->question; ?></h1>
        <p class="faq-answer"><?= $question->answer; ?></p>
    </div>
<?php
    endforeach;
?>
