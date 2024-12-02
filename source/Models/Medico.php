<?php

namespace Source\Models;

use PDOException;
use Source\Core\Connect;

class Medico {

    protected $entity = 'medicos';
    private $id;
    private $nome;
    private $crm;
    private $especialidade;
    private $email;
    private $telefone;
    private $endereco;
    private $cidade;
    private $estado;
    private $status;

    // Construtor
    public function __construct($nome, $crm, $especialidade, $email, $telefone, $endereco, $cidade, $estado, $status, $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->crm = $crm;
        $this->especialidade = $especialidade;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->status = $status;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCrm() {
        return $this->crm;
    }

    public function getEspecialidade() {
        return $this->especialidade;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getStatus() {
        return $this->status;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCrm($crm) {
        $this->crm = $crm;
    }

    public function setEspecialidade($especialidade) {
        $this->especialidade = $especialidade;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    // Método para inserir dados do médico no banco
    public function insert() {
        if (empty($this->nome) || empty($this->crm) || empty($this->especialidade) || empty($this->email) ||
            empty($this->telefone) || empty($this->endereco) || empty($this->cidade) || empty($this->estado) ||
            empty($this->status)) {
            throw new PDOException("Todos os campos são obrigatórios.");
        }

        $query = "INSERT INTO medicos (nome, crm, especialidade, email, telefone, endereco, cidade, estado, status) 
                  VALUES (:nome, :crm, :especialidade, :email, :telefone, :endereco, :cidade, :estado, :status)";
        $stmt = Connect::getInstance()->prepare($query);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":crm", $this->crm);
        $stmt->bindParam(":especialidade", $this->especialidade);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":cidade", $this->cidade);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":status", $this->status);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao inserir o médico: " . $e->getMessage());
        }
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
