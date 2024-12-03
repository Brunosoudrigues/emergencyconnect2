<?php

ob_start();

require __DIR__ . "/../vendor/autoload.php";

// Cabeçalhos para permitir o acesso à API
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header('Access-Control-Allow-Credentials: true'); // Permitir credenciais

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

use CoffeeCode\Router\Router;

$route = new Router(url(), ":");

$route->namespace("Source\App\Api");

/* USERS */
$route->get("/", "Users:listUsers");
$route->post("/user", "Users:createUser");
$route->get("/me", "Users:getUser");
$route->post("/login", "Users:loginUser");
$route->post("/update", "Users:updateUser");
$route->post("/set-password", "Users:setPassword");
$route->get("/token-validate", "Users:tokenValidate");

$route->group("/medicos");

    // Rota para criar um novo médico
    $route->post("/", "Medicos:createMedico");

    $route->get("/list", "Medicos:getAllMedicos");


$route->group("null");

/* FAQS */
$route->group("/faqs");
$route->post("/create", "Faqs:createFaq");
$route->post("/faq/{id}", "Faqs:updateFaq");
$route->get("/list", "Faqs:getAllFaqs");
$route->get("/updatefaq/{id}", "Faqs:editFaq"); // Rota para carregar o formulário de edição

    $route->get("/", "Faqs:listFaqs");
$route->group("null");

/* EMERGENCY FORMS */
$route->group("/emergencyForms");

    $route->post("/", "EmergencyForms:createEmergencyForm");
    $route->get("/occurrences/{cpf}", "EmergencyForms:getOccurrencesByCpf"); // Buscar por CPF
    $route->get("/occurrences", "EmergencyForms:getAllOccurrences"); // Buscar todas as ocorrências

$route->group("null");

/* SERVICES CATEGORIES */
$route->group("/services-categories");
    $route->post("/", "ServicesCategories:insert");
    $route->get("/", "ServicesCategories:getCategory");
    $route->put("/", "ServicesCategories:update");
    $route->delete("/", "ServicesCategories:remove");
$route->group("null");

/** ERROR HANDLER */
$route->dispatch();

/** ERROR REDIRECT */
if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "errors" => [
            "type" => "endpoint_not_found",
            "message" => "Não foi possível processar a requisição"
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

ob_end_flush();
