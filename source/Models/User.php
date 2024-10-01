<?php

namespace Source\Models;

use PDOException;
use Source\Core\Connect;
use Source\Core\Model;

class User extends Model {
    private $id;
    private $name;
    private $email;
    private $password;
    private $address;
    private $message;

    public function __construct(
        int $id = null,
        string $name = null,
        string $email = null,
        string $password = null,
        string $address = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->entity = "users";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function insert(): ?int
{
    $conn = Connect::getInstance();

    // Validação do email
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $this->message = "E-mail Inválido!";
        return false;
    }

    // Verificar se o email já existe
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email", $this->email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $this->message = "E-mail já cadastrado!";
        return false;
    }

    // Hash da senha
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);

    // Inserir dados no banco
    $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":password", $this->password);

    try {
        $stmt->execute();
        echo "Usuário cadastrado com sucesso!";
        return $conn->lastInsertId();
    } catch (PDOException $e) {
        echo "Erro ao inserir no banco de dados: " . $e->getMessage();
        return false;
    }
}

public function login(string $email, string $password): array
{
    $query = "SELECT * FROM users WHERE email = :email";
    $conn = Connect::getInstance();
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Use PDO::FETCH_ASSOC para obter um array associativo

    if (!$result) {
        return [
            "type" => "error",
            "message" => "E-mail não cadastrado!",
        ];
    }

    if (!password_verify($password, $result['password'])) {
        return [
            "type" => "error",
            "message" => "Senha incorreta!",
        ];
    }

    // Se login for bem-sucedido
    $this->setId($result['id']);
    $this->setName($result['name']);
    $this->setEmail($result['email']);

    return [
        "type" => "success",
        "name" => $result['name'], // Retorna o nome do usuário
        "message" => "Usuário logado com sucesso!",
    ];
}



    public function update () : bool
    {
        $conn = Connect::getInstance();

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->message = "E-mail inválido!";
            return false;
        }

        $query = "SELECT * FROM users WHERE email LIKE :email AND id != :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        if($stmt->rowCount() == 1) {
            $this->message = "E-mail já cadastrado!";
            return false;
        }

        $query = "UPDATE users 
                  SET name = :name, email = :email, address = :address
                  WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":id", $this->id);

        try {
            $stmt->execute();
            $this->message = "Usuário atualizado com sucesso!";
            return true;
        } catch (PDOException $exception) {
            $this->message = "Erro ao atualizar: {$exception->getMessage()}";
            return false;
        }

    }

    public function updatePassword (string $password, string $newPassword, string $confirmNewPassword) : bool
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $result = $stmt->fetch();

        if (!password_verify($password, $result->password)) {
            $this->message = "Senha incorreta!";
            return false;
        }

        if ($newPassword != $confirmNewPassword) {
            $this->message = "As senhas não conferem!";
            return false;
        }

        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $query = "UPDATE users 
                  SET password = :password 
                  WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":password", $newPassword);
        $stmt->bindParam(":id", $this->id);

        try {
            $stmt->execute();
            $this->message = "Senha atualizada com sucesso!";
            return true;
        } catch (PDOException $exception) {
            $this->message = "Erro ao atualizar: {$exception->getMessage()}";
            return false;
        }

    }


}