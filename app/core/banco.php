<?php

namespace App\Core;

require_once __DIR__ . '/../config.php';

    class Banco {
        public $banco;

        private $host = "localhost";
        private $usuario = "root";
        private $senha = "";
        private $nomeBanco = "gamerboxxd";

        public function __construct() {
            $this->banco = new \mysqli($this->host, $this->usuario, $this->senha, $this->nomeBanco);

            if ($this->banco->connect_error) {
                die("Erro de conexão: " . $this->banco->connect_error);
            }

            $this->banco->set_charset("utf8");
        }
    }
?>
