<?php

namespace App\DAO;

use App\Core\Banco;
use App\Models\Review;
use PDO;

    class ReviewDAO {

        private $conexao;

        public function __construct() {
            $this->conexao = (new Banco())->conectar();
        }

        public function inserir(Review $review) {
            $sql = "INSERT INTO reviews (id_jogo, id_usuario, nota, comentario, data) 
                    VALUES (:id_jogo, :id_usuario, :nota, :comentario, :data)";
            
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id_jogo', $review->getIdJogo(), PDO::PARAM_INT);
            $query->bindValue(':id_usuario', $review->getIdUsuario(), PDO::PARAM_INT);
            $query->bindValue(':nota', $review->getNota(), PDO::PARAM_INT);
            $query->bindValue(':comentario', $review->getComentario(), PDO::PARAM_STR);
            $query->bindValue(':data', $review->getData(), PDO::PARAM_STR);
            
            return $query->execute();
        }

        public function listarTodos() {
            $sql = "SELECT * FROM reviews";
            $query = $this->conexao->query($sql);

            $lista = [];
            while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                $lista[] = new Review(
                    $linha["id"],
                    $linha["id_jogo"],
                    $linha["id_usuario"],
                    $linha["nota"],
                    $linha["comentario"],
                    $linha["data"]
                );
            }

            return $lista;
        }

        public function buscarPorId($id) {
            $sql = "SELECT * FROM reviews WHERE id = :id";
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();

            $linha = $query->fetch(PDO::FETCH_ASSOC);
            if ($linha) {
                return new Review(
                    $linha["id"],
                    $linha["id_jogo"],
                    $linha["id_usuario"],
                    $linha["nota"],
                    $linha["comentario"],
                    $linha["data"]
                );
            }

            return null;
        }

        public function atualizar(Review $review) {
            $sql = "UPDATE reviews 
                    SET id_jogo = :id_jogo, id_usuario = :id_usuario, nota = :nota, comentario = :comentario, data = :data 
                    WHERE id = :id";
            
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id_jogo', $review->getIdJogo(), PDO::PARAM_INT);
            $query->bindValue(':id_usuario', $review->getIdUsuario(), PDO::PARAM_INT);
            $query->bindValue(':nota', $review->getNota(), PDO::PARAM_INT);
            $query->bindValue(':comentario', $review->getComentario(), PDO::PARAM_STR);
            $query->bindValue(':data', $review->getData(), PDO::PARAM_STR);
            $query->bindValue(':id', $review->getId(), PDO::PARAM_INT);

            return $query->execute();
        }

        public function deletar($id) {
            $sql = "DELETE FROM reviews WHERE id = :id";
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            return $query->execute();
        }
    }
?>
