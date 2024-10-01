<?php
const CONF_DB_HOST = "localhost";
const CONF_DB_USER = "root";
const CONF_DB_PASS = "";
// aqui deve ser alterado para o nome do banco de dados
const CONF_DB_NAME = "bd_emergencyconnect";
const CONF_URL_TEST = "http://localhost/emergencyconnect2";
const CONF_URL_BASE = "http://localhost/emergencyconnect2";
try {
    $conn = new PDO("mysql:host=" . CONF_DB_HOST . ";dbname=" . CONF_DB_NAME, CONF_DB_USER, CONF_DB_PASS);
    // Definir o modo de erro PDO para exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
