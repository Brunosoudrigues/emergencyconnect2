<?php

namespace Source\Core;

use PDO;
use PDOException;

class Connect
{
    private const OPTIONS = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ];

    private static ?PDO $instance = null;

    public static function getInstance(): ?PDO
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . CONF_DB_HOST . ";dbname=" . CONF_DB_NAME,
                    CONF_DB_USER,
                    CONF_DB_PASS,
                    self::OPTIONS
                );
            } catch (PDOException $exception) {
                // Em produção, redirecione para uma página de erro ou registre o erro em um log
                echo "Problemas ao Conectar...";
                error_log($exception->getMessage()); // Registra o erro em um arquivo de log
            }
        }

        return self::$instance;
    }

    final private function __construct()
    {
        // Impede a criação de uma nova instância via construtor
    }

    private function __clone()
    {
        // Impede a clonagem da instância
    }
}
