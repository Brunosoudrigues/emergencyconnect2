<?php

namespace Source\App\Api;

use


class EmergencyForms extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    // Método para criar um novo formulário de emergência
    public function createEmergencyForm(array $data)
    {
        // Verifica se todos os campos foram preenchidos
        if (in_array("", $data)) {
            $this->back([
                "type" => "error",
                "message" => "Preencha todos os campos!"
            ]);
            return;
        }

        // Cria uma nova instância da classe EmergencyForm
        $emergencyForm = new EmergencyForm(
            $data['cpf'],
            $data['healthCondition'],
            $data['typeOfIncident'],
            $data['address'],
            $data['painLocation'],
            $data['breathing'],
            $data['consciousness'],
            $data['injuries'],
            $data['allergies'],
            $data['medications'],
            $data['emergencyContact']
        );

        // Tenta inserir os dados
        $insertedId = $emergencyForm->insert();

        if (!$insertedId) {
            // Retorna mensagem de erro
            $this->back([
                "type" => "error",
                "message" => $emergencyForm->getMessage()
            ]);
            return;
        }

        // Retorna sucesso com o ID do registro criado
        $this->back([
            "type" => "success",
            "message" => "Formulário de emergência criado com sucesso!",
            "id" => $insertedId
        ]);
    }
}
