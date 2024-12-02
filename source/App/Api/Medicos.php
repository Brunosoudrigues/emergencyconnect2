<?php

namespace Source\App\Api;

use Source\Models\Medico;
use PDOException;

class Medicos extends Api {

    // Função para criar um novo médico
    public function createMedico(array $data) {
        // Verifica se todos os campos obrigatórios estão presentes
        $required_keys = ['nome', 'crm', 'especialidade', 'email', 'telefone', 'endereco', 'cidade', 'estado', 'status'];

        foreach ($required_keys as $key) {
            if (!isset($data[$key])) {
                throw new PDOException("Campo '{$key}' é obrigatório.");
            }
        }

        // Instancia um novo objeto Medico com os dados recebidos
        $medico = new Medico(
            $data['nome'],
            $data['crm'],
            $data['especialidade'],
            $data['email'],
            $data['telefone'],
            $data['endereco'],
            $data['cidade'],
            $data['estado'],
            $data['status']
        );

        try {
            // Chama o método insert do modelo para salvar o médico no banco
            $result = $medico->insert();

            if ($result) {
                // Se a inserção for bem-sucedida, retorna uma resposta de sucesso
                $this->back([
                    "type" => "success",
                    "message" => "Médico cadastrado com sucesso!"
                ]);
            } else {
                // Caso contrário, retorna uma mensagem de erro
                $this->back([
                    "type" => "error",
                    "message" => "Erro ao cadastrar médico."
                ]);
            }
        } catch (PDOException $e) {
            // Em caso de erro na inserção, retorna uma mensagem de erro com detalhes
            $this->back([
                "type" => "error",
                "message" => "Erro ao inserir dados: " . $e->getMessage()
            ]);
        }
    }

    public function getAllMedicos()
    {
        // Criação do objeto EmergencyForm e obtenção de todas as ocorrências
        $form = new Medico('', '', '', '', '', '', '', '', '', '');
        $list = $form->getAll();

        if (empty($list)) {
            $this->back([
                'type' => 'error',
                'message' => 'Nenhum Profissional registrado.'
            ]);
            return;
        }

        // Retorna todas as ocorrências encontradas
        $this->back([
            'type' => 'success',
            'message' => 'Todos Profissionais',
            'data' => $list
        ]);
    }


}
