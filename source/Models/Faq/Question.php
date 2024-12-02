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

    // Getter e Setter para 'idType'
    

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
        $query = "INSERT INTO {$this->entity} ( question, answer) VALUES ( :question, :answer)";
        $stmt = Connect::getInstance()->prepare($query);

        $stmt->bindValue(":question", $this->question, \PDO::PARAM_STR);
        $stmt->bindValue(":answer", $this->answer, \PDO::PARAM_STR);
        return $stmt->execute();
    }


    public function update(): bool
{
    $query = "UPDATE {$this->entity} SET question = :question, answer = :answer, status = :status WHERE id = :id";
    $stmt = Connect::getInstance()->prepare($query);

    // Vincula os valores aos parâmetros da consulta
    $stmt->bindValue(":id", $this->id, \PDO::PARAM_INT);
    $stmt->bindValue(":question", $this->question, \PDO::PARAM_STR);
    $stmt->bindValue(":answer", $this->answer, \PDO::PARAM_STR);
    
    // Executa a consulta
    return $stmt->execute();
}

}
?>
