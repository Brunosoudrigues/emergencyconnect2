<?php

namespace Source\Core;

use PDO;
use PDOException;

abstract class Model
{
    protected $entity;
    private $message;

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function selectAll(): ?array
    {
        $conn = Connect::getInstance();
        $query = "SELECT * FROM {$this->entity}";
        return $conn->query($query)->fetchAll();
    }

    public function selectById(int $id): ?object
    {
        $conn = Connect::getInstance();
        $query = "SELECT * 
                  FROM {$this->entity}
                  WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insert(): ?int
    {
        $values = get_object_vars($this); // Pega os valores dos atributos do objeto
        unset($values['entity'], $values['message']); // Remove propriedades indesejadas

        $columns = array_keys($values);
        $placeholders = array_map(fn($col) => ":{$col}", $columns);

        $columnsString = implode(", ", $columns);
        $placeholdersString = implode(", ", $placeholders);

        $conn = Connect::getInstance();
        $query = "INSERT INTO {$this->entity} ({$columnsString}) VALUES ({$placeholdersString})";
        $stmt = $conn->prepare($query);

        foreach ($values as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        try {
            $stmt->execute();
            $this->message = "Registro inserido com sucesso!";
            return $conn->lastInsertId();
        } catch (PDOException $exception) {
            $this->message = "Erro ao inserir: {$exception->getMessage()}";
            return false;
        }
    }
}
    