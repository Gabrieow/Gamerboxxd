<?php

namespace App\Controllers;

use App\DAO\ComentarioDAO;
use App\Models\Comentario;

    class ComentarioController {

        private $comentarioDAO;

        public function __construct() {
            $this->comentarioDAO = new ComentarioDAO();
        }

        public function criar($dados) {
            $comentario = new Comentario(
                null,
                $dados['id_review'],
                $dados['id_usuario'],
                $dados['texto'],
                $dados['data'] ?? date('Y-m-d H:i:s')
            );

            return $this->comentarioDAO->inserir($comentario);
        }

        public function listar() {
            return $this->comentarioDAO->listarTodos();
        }

        public function buscar($id) {
            return $this->comentarioDAO->buscarPorId($id);
        }

        public function atualizar($id, $dados) {
            $comentario = $this->comentarioDAO->buscarPorId($id);
            if (!$comentario) {
                return false;
            }

            $comentario->setIdReview($dados['id_review'] ?? $comentario->getIdReview());
            $comentario->setIdUsuario($dados['id_usuario'] ?? $comentario->getIdUsuario());
            $comentario->setTexto($dados['texto'] ?? $comentario->getTexto());
            $comentario->setData($dados['data'] ?? $comentario->getData());

            return $this->comentarioDAO->atualizar($comentario);
        }

        public function deletar($id) {
            return $this->comentarioDAO->deletar($id);
        }
    }
?>