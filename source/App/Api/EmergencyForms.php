<?php

namespace Source\App\Api;

use Source\Models\EmergencyForm;

class EmergencyForms extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createEmergencyForm(array $data)
    {
        // Validar campos obrigatórios
        if (empty($data['cpf']) || empty($data['healthCondition']) || empty($data['typeOfIncident'])) {
            $this->back([
                'type' => 'error',
                'message' => 'CPF, condição de saúde e tipo de incidente são obrigatórios!'
            ]);
            return;
        }

        // Validação do CPF (simples e mais robusta)
        if (!preg_match('/^\d{11}$/', $data['cpf'])) {
            $this->back([
                'type' => 'error',
                'message' => 'CPF inválido! O CPF deve conter 11 dígitos numéricos.'
            ]);
            return;
        }

        // Criação do objeto EmergencyForm com os dados recebidos
        $form = new EmergencyForm(
            $data['cpf'],
            $data['healthCondition'],
            $data['typeOfIncident'],
            $data['address'] ?? null,
            $data['painLocation'] ?? null,
            $data['breathing'] ?? null,
            $data['consciousness'] ?? null,
            $data['injuries'] ?? null,
            $data['allergies'] ?? null,
            $data['medications'] ?? null,
            $data['emergencyContact'] ?? null
        );

        // Inserção no banco de dados
        $insertedId = $form->insert();

        if (!$insertedId) {
            // Caso haja erro na inserção, retornar a mensagem de erro
            $this->back([
                'type' => 'error',
                'message' => $form->getMessage() ?? 'Erro desconhecido ao tentar salvar o formulário.'
            ]);
            return;
        }

        // Se inserido com sucesso, retornar a resposta com o ID
        $this->back([
            'type' => 'success',
            'message' => 'Formulário de emergência criado com sucesso!',
            'id' => $insertedId
        ]);
    }
    // Método para listar ocorrências com base no CPF
    public function getOccurrencesByCpf(array $data)
    {
        if (empty($data['cpf'])) {
            $this->back([
                'type' => 'error',
                'message' => 'CPF é obrigatório!'
            ]);
            return;
        }

        // Criação do objeto EmergencyForm e obtenção das ocorrências
        $form = new EmergencyForm('', '', '', '', '', '', '', '', '', '', '');
        $occurrences = $form->getByCpf($data['cpf']);

        if (empty($occurrences)) {
            $this->back([
                'type' => 'error',
                'message' => 'Nenhuma ocorrência encontrada para o CPF informado.'
            ]);
            return;
        }

        // Retorna as ocorrências encontradas
        $this->back([
            'type' => 'success',
            'message' => 'Ocorrências encontradas.',
            'data' => $occurrences
        ]);
    }

    // Método para listar todas as ocorrências
    public function getAllOccurrences()
    {
        // Criação do objeto EmergencyForm e obtenção de todas as ocorrências
        $form = new EmergencyForm('', '', '', '', '', '', '', '', '', '', '');
        $occurrences = $form->getAll();

        if (empty($occurrences)) {
            $this->back([
                'type' => 'error',
                'message' => 'Nenhuma ocorrência registrada.'
            ]);
            return;
        }

        // Retorna todas as ocorrências encontradas
        $this->back([
            'type' => 'success',
            'message' => 'Todas as ocorrências.',
            'data' => $occurrences
        ]);
    }

}


