<?php
namespace Source\Models;

use Source\Core\Model;

class EmergencyForm extends Model
{
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

    public function __construct($cpf, $healthCondition, $typeOfIncident, $address, $painLocation, $breathing, $consciousness, $injuries, $allergies, $medications, $emergencyContact)
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

    public function insert()
    {
        // Abaixo está um exemplo de inserção usando PDO
        try {
            $query = "INSERT INTO first_aid_reports (cpf, health_condition, type_of_incident, address, pain_location, breathing, consciousness, injuries, allergies, medications, emergency_contact) 
                      VALUES (:cpf, :health_condition, :type_of_incident, :address, :pain_location, :breathing, :consciousness, :injuries, :allergies, :medications, :emergency_contact)";

            $stmt = $this->getConnection()->prepare($query);
            $stmt->bindValue(':cpf', $this->cpf);
            $stmt->bindValue(':health_condition', $this->healthCondition);
            $stmt->bindValue(':type_of_incident', $this->typeOfIncident);
            $stmt->bindValue(':address', $this->address);
            $stmt->bindValue(':pain_location', $this->painLocation);
            $stmt->bindValue(':breathing', $this->breathing);
            $stmt->bindValue(':consciousness', $this->consciousness);
            $stmt->bindValue(':injuries', $this->injuries);
            $stmt->bindValue(':allergies', $this->allergies);
            $stmt->bindValue(':medications', $this->medications);
            $stmt->bindValue(':emergency_contact', $this->emergencyContact);
            
            $stmt->execute();
            return $this->getConnection()->lastInsertId(); // Retorna o ID do último registro inserido
        } catch (\Exception $e) {
            error_log("Erro ao inserir dados: " . $e->getMessage());
            return false; // Retorna false em caso de erro
        }
    }
}
