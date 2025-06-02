<?php

namespace App\Controllers;

use App\DAO\JogoDAO;
use App\Models\Jogo;

    class JogoController {

        private $dao;

        public function __construct() {
            $this->dao = new JogoDAO();
        }

        public function index() {
            $jogos = $this->dao->listarTodos();
            include __DIR__ . '/../Views/jogos/listar.php';
        }

        public function criar() {
            include __DIR__ . '/../Views/jogos/criar.php';
        }

        public function salvar() {
            $jogo = new Jogo(
                null,
                $_POST['nome'] ?? '',
                $_POST['categoria'] ?? '',
                $_POST['plataforma'] ?? '',
                $_POST['desenvolvedor'] ?? '',
                $_POST['data_lancamento'] ?? null,
                $_POST['imagem_url'] ?? '',
                $_POST['descricao'] ?? ''
            );

            $this->dao->inserir($jogo);
            header('Location: index.php?pagina=jogos');
        }

        public function editar($id) {
            $jogo = $this->dao->buscarPorId($id);
            if (!$jogo) {
                echo "Jogo não encontrado!";
                exit;
            }
            include __DIR__ . '/../Views/jogos/editar.php';
        }

        public function atualizar() {
            $jogo = new Jogo(
                $_POST['id'] ?? null,
                $_POST['nome'] ?? '',
                $_POST['categoria'] ?? '',
                $_POST['plataforma'] ?? '',
                $_POST['desenvolvedor'] ?? '',
                $_POST['data_lancamento'] ?? null,
                $_POST['imagem_url'] ?? '',
                $_POST['descricao'] ?? ''
            );

            $this->dao->atualizar($jogo);
            header('Location: index.php?pagina=jogos');
        }

        public function deletar($id) {
            $this->dao->deletar($id);
            header('Location: index.php?pagina=jogos');
        }
    }
?>