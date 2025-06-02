<?php

namespace App\DAO;

use App\Core\Banco;
use App\Models\Curtida;
use PDO;

    class CurtidaDAO {

        private $conexao;

        public function __construct() {
            $this->conexao = (new Banco())->conectar();
        }

        public function inserir(Curtida $curtida) {
            $sql = "INSERT INTO curtidas (id_review, id_usuario, data) 
                    VALUES (:id_review, :id_usuario, :data)";

            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id_review', $curtida->getIdReview(), PDO::PARAM_INT);
            $query->bindValue(':id_usuario', $curtida->getIdUsuario(), PDO::PARAM_INT);
            $query->bindValue(':data', $curtida->getData(), PDO::PARAM_STR);

            return $query->execute();
        }

        public function listarTodos() {
            $sql = "SELECT * FROM curtidas ORDER BY data DESC";
            $query = $this->conexao->query($sql);

            $lista = [];

            while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                $lista[] = new Curtida(
                    $linha['id'],
                    $linha['id_review'],
                    $linha['id_usuario'],
                    $linha['data']
                );
            }

            return $lista;
        }

        public function buscarPorId($id) {
            $sql = "SELECT * FROM curtidas WHERE id = :id";

            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();

            $linha = $query->fetch(PDO::FETCH_ASSOC);

            if ($linha) {
                return new Curtida(
                    $linha['id'],
                    $linha['id_review'],
                    $linha['id_usuario'],
                    $linha['data']
                );
            }

            return null;
        }

        public function deletar($id) {
            $sql = "DELETE FROM curtidas WHERE id = :id";

            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            return $query->execute();
        }

        public function deletarPorUsuarioEReview($id_usuario, $id_review) {
            $sql = "DELETE FROM curtidas WHERE id_usuario = :id_usuario AND id_review = :id_review";

            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $query->bindValue(':id_review', $id_review, PDO::PARAM_INT);

            return $query->execute();
        }

        public function verificarCurtida($id_usuario, $id_review) {
            $sql = "SELECT COUNT(*) FROM curtidas WHERE id_usuario = :id_usuario AND id_review = :id_review";

            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $query->bindValue(':id_review', $id_review, PDO::PARAM_INT);
            $query->execute();

            return $query->fetchColumn() > 0;
        }
    }
?>