<?php

namespace Source\App\Api;

use Source\Core\TokenJWT;
use Source\Models\User;

class Users extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUser ()
    {
        $this->auth();

        $users = new User();
        $user = $users->selectById($this->userAuth->id);

        $this->back([
            "type" => "success",
            "message" => "Usuário autenticado",
            "user" => [
                "id" => $this->userAuth->id,
                "name" => $this->userAuth->name,
                "email" => $this->userAuth->email,
                "address" => $user->address
            ]
        ]);

    }

    public function tokenValidate ()
    {
        $this->auth();

        $this->back([
            "type" => "success",
            "message" => "Token válido",
            "user" => [
                "id" => $this->userAuth->id,
                "name" => $this->userAuth->name,
                "email" => $this->userAuth->email
            ]
        ]);
    }

    public function listUsers ()
    {
        $this->auth();
        $users = new User();
        $this->back($users->selectAll());
    }

    public function createUser(array $data)
{
    // Verifique se todos os campos necessários estão preenchidos
    if (empty($data["name"]) || empty($data["email"]) || empty($data["password"])) {
        $this->back([
            "type" => "error",
            "message" => "Preencha todos os campos"
        ]);
        return;
    }

    // Crie o usuário com os dados fornecidos
    $user = new User(
        null,
        $data["name"],
        $data["email"],
        $data["password"]
    );

    // Tente inserir o usuário no banco de dados
    $insertUser = $user->insert();

    // Se a inserção falhar, mostre a mensagem de erro
    if (!$insertUser) {
        $this->back([
            "type" => "error",
            "message" => $user->getMessage()
        ]);
        return;
    }

    // Se tudo ocorreu bem, confirme o cadastro do usuário
    $this->back([
        "type" => "success",
        "message" => "Usuário cadastrado com sucesso!"
    ]);
}

public function loginUser(array $data) {
    // Crie um novo objeto User
    $user = new User();
    
    // Verifique se os campos de email e senha estão preenchidos
    if (empty($data["email"]) || empty($data["password"])) {
        $this->back([
            "type" => "error",
            "message" => "Preencha todos os campos"
        ]);
        return;
    }

    // Tente fazer login
    if (!$user->login($data["email"], $data["password"])) {
        $this->back([
            "type" => "error",
            "message" => $user->getMessage()
        ]);
        return;
    }

    // Se o login for bem-sucedido, gere um token JWT
    $token = new TokenJWT();
    $this->back([
        "type" => "success",
        "message" => $user->getMessage(),
        "user" => [
            "id" => $user->getId(),
            "name" => $user->getName(),
            "email" => $user->getEmail(),
            "token" => $token->create([
                "id" => $user->getId(),
                "name" => $user->getName(),
                "email" => $user->getEmail()
            ])
        ]
    ]);
}

    
    public function updateUser(array $data)
    {
        if(!$this->userAuth){
            $this->back([
                "type" => "error",
                "message" => "Você não pode estar aqui.."
            ]);
            return;
        }

        $user = new User(
            $this->userAuth->id,
            $data["name"],
            $data["email"]
        );

        if(!$user->update()){
            $this->back([
                "type" => "error",
                "message" => $user->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => $user->getMessage(),
            "user" => [
                "id" => $user->getId(),
                "name" => $user->getName(),
                "email" => $user->getEmail()
            ]
        ]);
    }

    public function setPassword(array $data)
    {
        if(!$this->userAuth){
            $this->back([
                "type" => "error",
                "message" => "Você não pode estar aqui.."
            ]);
            return;
        }

        $user = new User($this->userAuth->id);

        if(!$user->updatePassword($data["password"],$data["newPassword"],$data["confirmNewPassword"])){
            $this->back([
                "type" => "error",
                "message" => $user->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => $user->getMessage()
        ]);
    }
}