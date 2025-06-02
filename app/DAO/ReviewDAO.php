<?php

namespace App\DAO;

use App\Core\Banco;
use App\Models\Review;

    class ReviewDAO {

        private $conexao;

        public function __construct() {
            $this->conexao = (new Banco())->banco; 
        }

        public function inserir(Review $review) {
            $sql = "INSERT INTO reviews (id_jogo, id_usuario, nota, comentario, data) 
                    VALUES (?, ?, ?, ?, ?)";

            $query = $this->conexao->prepare($sql);
            $query->bind_param(
                "iiiss",
                $review->getIdJogo(),
                $review->getIdUsuario(),
                $review->getNota(),
                $review->getComentario(),
                $review->getData()
            );

            return $query->execute();
        }

        public function listarTodos() {
            $sql = "SELECT * FROM reviews";
            $resultado = $this->conexao->query($sql);

            $lista = [];
            if ($resultado) {
                while ($linha = $resultado->fetch_assoc()) {
                    $lista[] = new Review(
                        $linha["id"],
                        $linha["id_jogo"],
                        $linha["id_usuario"],
                        $linha["nota"],
                        $linha["comentario"],
                        $linha["data"]
                    );
                }
            }

            return $lista;
        }

        public function buscarPorId($id) {
            $sql = "SELECT * FROM reviews WHERE id = ?";
            $query = $this->conexao->prepare($sql);
            $query->bind_param("i", $id);
            $query->execute();

            $resultado = $query->get_result();
            $linha = $resultado->fetch_assoc();

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
            $sql = "UPDATE reviews SET id_jogo = ?, id_usuario = ?, nota = ?, comentario = ?, data = ? WHERE id = ?";
            $query = $this->conexao->prepare($sql);
            $query->bind_param(
                "iisssi",
                $review->getIdJogo(),
                $review->getIdUsuario(),
                $review->getNota(),
                $review->getComentario(),
                $review->getData(),
                $review->getId()
            );

            return $query->execute();
        }

        public function deletar($id) {
            $sql = "DELETE FROM reviews WHERE id = ?";
            $query = $this->conexao->prepare($sql);
            $query->bind_param("i", $id);
            return $query->execute();
        }
    }
?>