<?php

namespace Source\Models;

use PDOException;
use Source\Core\Connect;
use Source\Core\Model;

class EmergencyForm extends Model
{
    protected $entity = 'emergency_forms';

    private $cpf;
    private $healthCondition;
    private $typeOfIncident;
    private $address;
    private $painLocation;
    private $breathing;
    private $consciousness;
    private $injuries;
    private $allergies;
    private $medications;
    private $emergencyContact;

    // Propriedade de mensagem (evitar erro de depreciação)
    private $message;

    public function __construct($cpf, $healthCondition, $typeOfIncident, $address = null, $painLocation = null, $breathing = null, $consciousness = null, $injuries = null, $allergies = null, $medications = null, $emergencyContact = null)
    {
        $this->cpf = $cpf;
        $this->healthCondition = $healthCondition;
        $this->typeOfIncident = $typeOfIncident;
        $this->address = $address;
        $this->painLocation = $painLocation;
        $this->breathing = $breathing;
        $this->consciousness = $consciousness;
        $this->injuries = $injuries;
        $this->allergies = $allergies;
        $this->medications = $medications;
        $this->emergencyContact = $emergencyContact;
    }

    // Getters and Setters for each private property

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getHealthCondition(): ?string
    {
        return $this->healthCondition;
    }

    public function setHealthCondition(?string $healthCondition): void
    {
        $this->healthCondition = $healthCondition;
    }

    public function getTypeOfIncident(): ?string
    {
        return $this->typeOfIncident;
    }

    public function setTypeOfIncident(?string $typeOfIncident): void
    {
        $this->typeOfIncident = $typeOfIncident;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getPainLocation(): ?string
    {
        return $this->painLocation;
    }

    public function setPainLocation(?string $painLocation): void
    {
        $this->painLocation = $painLocation;
    }

    public function getBreathing(): ?string
    {
        return $this->breathing;
    }

    public function setBreathing(?string $breathing): void
    {
        $this->breathing = $breathing;
    }

    public function getConsciousness(): ?string
    {
        return $this->consciousness;
    }

    public function setConsciousness(?string $consciousness): void
    {
        $this->consciousness = $consciousness;
    }

    public function getInjuries(): ?string
    {
        return $this->injuries;
    }

    public function setInjuries(?string $injuries): void
    {
        $this->injuries = $injuries;
    }

    public function getAllergies(): ?string
    {
        return $this->allergies;
    }

    public function setAllergies(?string $allergies): void
    {
        $this->allergies = $allergies;
    }

    public function getMedications(): ?string
    {
        return $this->medications;
    }

    public function setMedications(?string $medications): void
    {
        $this->medications = $medications;
    }

    public function getEmergencyContact(): ?string
    {
        return $this->emergencyContact;
    }

    public function setEmergencyContact(?string $emergencyContact): void
    {
        $this->emergencyContact = $emergencyContact;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    public function insert(): ?int
    {
        $conn = Connect::getInstance();

        // Validação do CPF
        if (!preg_match('/^\d{11}$/', $this->cpf)) {
            $this->message = "CPF inválido!";
            return false;
        }

        // Verificar se o CPF já está cadastrado
        $query = "SELECT * FROM {$this->entity} WHERE cpf LIKE :cpf";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->execute();

        

        // Preparar dados para inserção no banco de dados
        $values = get_object_vars($this);
        unset($values['entity'], $values['message']); // Remove as propriedades indesejadas

        $columns = array_keys($values);
        $placeholders = array_map(fn($col) => ":{$col}", $columns);

        $columnsString = implode(", ", $columns);
        $placeholdersString = implode(", ", $placeholders);

        // Inserção no banco de dados
        $query = "INSERT INTO {$this->entity} ({$columnsString}) VALUES ({$placeholdersString})";
        $stmt = $conn->prepare($query);

        foreach ($values as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        try {
            $stmt->execute();
            return $conn->lastInsertId();
        } catch (PDOException $exception) {
            $this->message = "Erro ao inserir o formulário de emergência: {$exception->getMessage()}";
            return false;
        }
    }


    public function getByCpf(string $cpf): array
    {
        $conn = Connect::getInstance();
        
        // Consulta SQL para buscar todas as ocorrências pelo CPF
        $query = "SELECT * FROM {$this->entity} WHERE cpf = :cpf";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Método para listar todas as ocorrências
    public function getAll(): array
    {
        $conn = Connect::getInstance();
        
        // Consulta SQL para buscar todas as ocorrências
        $query = "SELECT * FROM {$this->entity}";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}
