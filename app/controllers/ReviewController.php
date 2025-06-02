<?php

namespace App\Controllers;

use App\DAO\ReviewDAO;
use App\Models\Review;

    class ReviewController {

        private $reviewDAO;

        public function __construct() {
            $this->reviewDAO = new ReviewDAO();
        }

        public function listar() {
            $reviews = $this->reviewDAO->listarTodos();
            include "../views/reviews/listar.php";
        }

        public function exibirFormulario() {
            include "../views/reviews/formulario.php";
        }

        public function salvar() {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $review = new Review(
                    null,
                    $_POST["id_jogo"],
                    $_POST["id_usuario"],
                    $_POST["nota"],
                    $_POST["comentario"],
                    $_POST["data"]
                );

                $this->reviewDAO->inserir($review);
                header("Location: /review/listar");
            }
        }

        public function editar($id) {
            $review = $this->reviewDAO->buscarPorId($id);
            include "../views/reviews/formulario.php";
        }

        public function atualizar() {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $review = new Review(
                    $_POST["id"],
                    $_POST["id_jogo"],
                    $_POST["id_usuario"],
                    $_POST["nota"],
                    $_POST["comentario"],
                    $_POST["data"]
                );

                $this->reviewDAO->atualizar($review);
                header("Location: /review/listar");
            }
        }

        public function deletar($id) {
            $this->reviewDAO->deletar($id);
            header("Location: /review/listar");
        }
    }
?>