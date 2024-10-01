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
