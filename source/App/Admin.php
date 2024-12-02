<?php

namespace Source\App;

use League\Plates\Engine;

class Admin
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . "/../../themes/adm","php");
    }

    public function home ()
    {
        //echo "<h1>Eu sou a Home...</h1>";
        echo $this->view->render("home",[]);
    }

    public function products () {
        echo $this->view->render("products",[]);
    }
    public function Medico ()
    {
        echo $this->view->render("Medico", []);
    }
    
    public function listMedico ()
    {
        echo $this->view->render("listMedico", []);
    }
    public function updatefaq ()
    {
        echo $this->view->render("updatefaq", []);
    }
    public function viewfaq ()
    {
        echo $this->view->render("viewfaq", []);
    }
}