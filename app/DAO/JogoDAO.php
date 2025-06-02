<?php

namespace App\DAO;

use App\Models\Jogo;
use App\Core\Banco;

    class JogoDAO {

        private $conexao;

        public function __construct() {
            $this->conexao = (new Banco())->banco;
        }

        public function inserir(Jogo $jogo) {
            $sql = "INSERT INTO jogos (nome, categoria, plataforma, desenvolvedor, data_lancamento, imagem_url, descricao) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            $query = $this->conexao->prepare($sql);
            $query->bind_param(
                "sssssss",
                $jogo->getNome(),
                $jogo->getCategoria(),
                $jogo->getPlataforma(),
                $jogo->getDesenvolvedor(),
                $jogo->getDataLancamento(),
                $jogo->getImagemUrl(),
                $jogo->getDescricao()
            );

            return $query->execute();
        }

        public function listarTodos() {
            $sql = "SELECT * FROM jogos ORDER BY nome";
            $resultado = $this->conexao->query($sql);

            $jogos = [];
            if ($resultado) {
                while ($row = $resultado->fetch_assoc()) {
                    $jogos[] = $this->criarJogoDeArray($row);
                }
            }

            return $jogos;
        }

        public function buscarPorId($id) {
            $sql = "SELECT * FROM jogos WHERE id = ?";
            $query = $this->conexao->prepare($sql);
            $query->bind_param("i", $id);
            $query->execute();

            $resultado = $query->get_result();
            $row = $resultado->fetch_assoc();

            return $row ? $this->criarJogoDeArray($row) : null;
        }

        public function atualizar(Jogo $jogo) {
            $sql = "UPDATE jogos SET nome = ?, categoria = ?, plataforma = ?, desenvolvedor = ?, data_lancamento = ?, imagem_url = ?, descricao = ? WHERE id = ?";
            $query = $this->conexao->prepare($sql);
            $query->bind_param(
                "sssssssi",
                $jogo->getNome(),
                $jogo->getCategoria(),
                $jogo->getPlataforma(),
                $jogo->getDesenvolvedor(),
                $jogo->getDataLancamento(),
                $jogo->getImagemUrl(),
                $jogo->getDescricao(),
                $jogo->getId()
            );

            return $query->execute();
        }

        public function deletar($id) {
            $sql = "DELETE FROM jogos WHERE id = ?";
            $query = $this->conexao->prepare($sql);
            $query->bind_param("i", $id);
            return $query->execute();
        }

        private function criarJogoDeArray(array $dados) {
            return new Jogo(
                $dados['id'],
                $dados['nome'],
                $dados['categoria'],
                $dados['plataforma'],
                $dados['desenvolvedor'],
                $dados['data_lancamento'],
                $dados['imagem_url'],
                $dados['descricao']
            );
        }
    }
?>