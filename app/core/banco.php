<?php

namespace App\Core;

use PDO;
use PDOException;

    class Banco {
        private $host = 'localhost';
        private $dbname = 'gamerboxxd';
        private $usuario = 'root';
        private $senha = '';

        public function conectar() {
            try {
                $conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->usuario, $this->senha);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
    }
?>