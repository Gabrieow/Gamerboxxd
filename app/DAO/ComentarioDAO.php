<?php

namespace App\DAO;

use App\Core\Banco;
use App\Models\Comentario;
use PDO;

    class ComentarioDAO {

        private $conexao;

        public function __construct() {
            $this->conexao = (new Banco())->conectar(); 
        }

        public function inserir(Comentario $comentario) {
            $sql = "INSERT INTO comentarios (id_review, id_usuario, texto, data) 
                    VALUES (:id_review, :id_usuario, :texto, :data)";

            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id_review', $comentario->getIdReview(), PDO::PARAM_INT);
            $query->bindValue(':id_usuario', $comentario->getIdUsuario(), PDO::PARAM_INT);
            $query->bindValue(':texto', $comentario->getTexto(), PDO::PARAM_STR);
            $query->bindValue(':data', $comentario->getData(), PDO::PARAM_STR);

            return $query->execute();
        }

        public function listarTodos() {
            $sql = "SELECT * FROM comentarios ORDER BY data DESC";
            $query = $this->conexao->query($sql);

            $lista = [];

            while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                $lista[] = new Comentario(
                    $linha['id'],
                    $linha['id_review'],
                    $linha['id_usuario'],
                    $linha['texto'],
                    $linha['data']
                );
            }

            return $lista;
        }

        public function buscarPorId($id) {
            $sql = "SELECT * FROM comentarios WHERE id = :id";
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();

            $linha = $query->fetch(PDO::FETCH_ASSOC);

            if ($linha) {
                return new Comentario(
                    $linha['id'],
                    $linha['id_review'],
                    $linha['id_usuario'],
                    $linha['texto'],
                    $linha['data']
                );
            }

            return null;
        }

        public function atualizar(Comentario $comentario) {
            $sql = "UPDATE comentarios 
                    SET id_review = :id_review, id_usuario = :id_usuario, texto = :texto, data = :data 
                    WHERE id = :id";

            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id_review', $comentario->getIdReview(), PDO::PARAM_INT);
            $query->bindValue(':id_usuario', $comentario->getIdUsuario(), PDO::PARAM_INT);
            $query->bindValue(':texto', $comentario->getTexto(), PDO::PARAM_STR);
            $query->bindValue(':data', $comentario->getData(), PDO::PARAM_STR);
            $query->bindValue(':id', $comentario->getId(), PDO::PARAM_INT);

            return $query->execute();
        }

        public function deletar($id) {
            $sql = "DELETE FROM comentarios WHERE id = :id";
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            return $query->execute();
        }
    }
?>