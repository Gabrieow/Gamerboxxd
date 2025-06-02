<?php

namespace App\Core;

use PDO;
use PDOException;

require_once __DIR__ . '/../config.php';

    class Banco {
        private $conexao;

        public function conectar() {
            global $db_host, $db_nome, $db_usuario, $db_senha;

            try {
                $this->conexao = new PDO(
                    "mysql:host=$db_host;dbname=$db_nome;charset=utf8",
                    $db_usuario,
                    $db_senha
                );
                $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $erro) {
                die("Erro de conexão: " . $erro->getMessage());
            }

            return $this->conexao;
        }
    }
?>