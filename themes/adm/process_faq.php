<?php

namespace Source\Models\Faq;

use Source\Core\Connect;
use Source\Core\Model;

class Question extends Model {

    protected $id;
    protected $question;
    protected $answer;

    public function __construct(int $id = null, string $question = null, string $answer = null)
    {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
        $this->entity = "questions";
    }

    // Getter e Setter para 'id'
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    // Getter e Setter para 'question'
    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(?string $question): void
    {
        $this->question = $question;
    }

    // Getter e Setter para 'answer'
    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(?string $answer): void
    {
        $this->answer = $answer;
    }

    // Método para inserção no banco de dados
    public function insert(): bool
    {
        $query = "INSERT INTO {$this->entity} (question, answer) VALUES (:question, :answer)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindValue(":question", $this->question, \PDO::PARAM_STR);
        $stmt->bindValue(":answer", $this->answer, \PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Método para atualização no banco de dados
    public function update(array $data): bool
    {
        if (empty($data['question']) || empty($data['answer']) || empty($data['id'])) {
            throw new \PDOException("Pergunta, resposta e ID são obrigatórios.");
        }

        $query = "UPDATE {$this->entity} SET question = :question, answer = :answer WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindValue(":question", $data['question'], \PDO::PARAM_STR);
        $stmt->bindValue(":answer", $data['answer'], \PDO::PARAM_STR);
        $stmt->bindValue(":id", $data['id'], \PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Método para buscar todos
    public function getAll(): array
    {
        $conn = Connect::getInstance();
        $query = "SELECT * FROM questions";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Método para buscar por ID
    public function selectById(int $id): ?object
    {
        $conn = Connect::getInstance();
        $query = "SELECT * FROM {$this->entity} WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            return new self($data['id'], $data['question'], $data['answer']);
        }

        return null; // Retorna null se não encontrar
    }
}

// Recebe e trata a requisição
$faqId = $_GET['id'] ?? null;
if (!$faqId || !is_numeric($faqId)) {
    echo json_encode(['success' => false, 'message' => 'ID da FAQ não fornecido ou inválido.']);
    exit;
}

$faqData = (new Question())->selectById($faqId);

if ($faqData === null) {
    echo json_encode(['success' => false, 'message' => 'FAQ não encontrada.']);
    exit;
}

$faqId = $faqData->getId();
$question = htmlspecialchars($faqData->getQuestion());
$answer = htmlspecialchars($faqData->getAnswer());

echo json_encode([
    'success' => true,
    'faqId' => $faqId,
    'question' => $question,
    'answer' => $answer
]);

?>
