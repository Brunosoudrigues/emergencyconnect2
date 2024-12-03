<?php
namespace Source\App\Api;

use Source\Models\Faq\Question;
use PDOException;

class Faqs extends Api
{
    // Função para listar todas as FAQs
    public function listFaqs(): void
    {
        $questions = new Question();
        $this->back($questions->selectAll(), 200);
    }

    // Função para criar uma nova FAQ
    public function createFaq(array $data): void
    {
        // Verifica se os campos obrigatórios estão presentes e não estão vazios
        if (empty($data['question']) || empty($data['answer'])) {
            throw new PDOException("Pergunta e resposta são obrigatórios.");
        }

        // Instancia um novo objeto Question com os dados recebidos
        $faq = new Question(
            null, // ID será gerado automaticamente pelo banco
            $data['question'],
            $data['answer']
        );

        try {
            // Insere a nova FAQ no banco de dados
            $faq->insert();

            // Retorna uma resposta de sucesso
            $this->back([
                "type" => "success",
                "message" => "FAQ cadastrada com sucesso!"
            ]);
        } catch (PDOException $e) {
            // Retorna erro caso a inserção falhe
            $this->back([
                "type" => "error",
                "message" => "Erro ao inserir a FAQ: " . $e->getMessage()
            ]);
        }
    }



    // Função para obter todas as FAQs
    public function getAllFaqs(): void
    {
        $questionModel = new Question();
        $list = $questionModel->getAll();

        if (empty($list)) {
            $this->back([
                'type' => 'error',
                'message' => 'Nenhuma FAQ encontrada.'
            ]);
            return;
        }

        // Retorna as FAQs em formato JSON
        $this->back([
            'type' => 'success',
            'message' => 'Todas as perguntas',
            'data' => $list
        ], 200);  // 200 é o código de status para sucesso
    }
    public function updateFaq($request, $response, $args)
    {
        // Pega o ID da FAQ da URL (da rota)
        $faqId = $args['id'];  // O ID vem de {id} na URL
        
        // Obtém os dados do corpo da requisição (presumivelmente em JSON)
        $data = $request->getParsedBody();
    
        // Verifica se os dados necessários foram enviados
        if (!isset($data['question']) || !isset($data['answer'])) {
            return $response->withJson([
                'success' => false,
                'message' => 'Pergunta e resposta são obrigatórios.'
            ], 400); // Retorna erro 400 se os dados estiverem incompletos
        }
    
        // Tenta obter a FAQ com o ID fornecido
        $faq = (new Question())->selectById($faqId);
        if ($faq === null) {
            return $response->withJson([
                'success' => false,
                'message' => 'FAQ não encontrada.'
            ], 404); // Retorna erro 404 se a FAQ não for encontrada
        }
    
        // Atualiza os dados da FAQ
        $faq->setQuestion($data['question']);
        $faq->setAnswer($data['answer']);
        
        // Salva as alterações no banco de dados
        if ($faq->update()) {
            return $response->withJson([
                'success' => true,
                'message' => 'FAQ atualizada com sucesso.',
                'data' => [
                    'faqId' => $faq->getId(),
                    'question' => $faq->getQuestion(),
                    'answer' => $faq->getAnswer()
                ]
            ]);
        } else {
            return $response->withJson([
                'success' => false,
                'message' => 'Erro ao atualizar a FAQ.'
            ], 500); // Retorna erro 500 se falhar ao atualizar
        }
    }
    

}

?>
