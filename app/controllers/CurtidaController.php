<?php

namespace App\Controllers;

use App\DAO\CurtidaDAO;
use App\Models\Curtida;

    class CurtidaController {

        private $curtidaDAO;

        public function __construct() {
            $this->curtidaDAO = new CurtidaDAO();
        }

        public function curtir($dados) {
            if ($this->curtidaDAO->verificarCurtida($dados['id_usuario'], $dados['id_review'])) {
                return false; // já curtiu
            }

            $curtida = new Curtida(
                null,
                $dados['id_review'],
                $dados['id_usuario'],
                $dados['data'] ?? date('Y-m-d H:i:s')
            );

            return $this->curtidaDAO->inserir($curtida);
        }

        public function listar() {
            return $this->curtidaDAO->listarTodos();
        }

        public function buscar($id) {
            return $this->curtidaDAO->buscarPorId($id);
        }

        public function descurtir($id_usuario, $id_review) {
            return $this->curtidaDAO->deletarPorUsuarioEReview($id_usuario, $id_review);
        }

        public function deletar($id) {
            return $this->curtidaDAO->deletar($id);
        }
    }
?>