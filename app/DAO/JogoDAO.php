<?php

namespace App\DAO;

use App\Models\Jogo;
use App\Core\Banco;
use PDO;

    class JogoDAO {

        private $conexao;

        public function __construct() {
            $this->conexao = (new Banco())->conectar();
        }

        public function inserir(Jogo $jogo) {
            $sql = "INSERT INTO jogos (nome, categoria, plataforma, desenvolvedor, data_lancamento, imagem_url, descricao) 
                    VALUES (:nome, :categoria, :plataforma, :desenvolvedor, :data_lancamento, :imagem_url, :descricao)";
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':nome', $jogo->getNome());
            $query->bindValue(':categoria', $jogo->getCategoria());
            $query->bindValue(':plataforma', $jogo->getPlataforma());
            $query->bindValue(':desenvolvedor', $jogo->getDesenvolvedor());
            $query->bindValue(':data_lancamento', $jogo->getDataLancamento());
            $query->bindValue(':imagem_url', $jogo->getImagemUrl());
            $query->bindValue(':descricao', $jogo->getDescricao());
            return $query->execute();
        }

        public function listarTodos() {
            $sql = "SELECT * FROM jogos ORDER BY nome";
            $query = $this->conexao->query($sql);

            $jogos = [];
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $jogos[] = $this->criarJogoDeArray($row);
            }

            return $jogos;
        }

        public function buscarPorId($id) {
            $sql = "SELECT * FROM jogos WHERE id = :id";
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row ? $this->criarJogoDeArray($row) : null;
        }

        public function atualizar(Jogo $jogo) {
            $sql = "UPDATE jogos SET 
                        nome = :nome, 
                        categoria = :categoria, 
                        plataforma = :plataforma, 
                        desenvolvedor = :desenvolvedor, 
                        data_lancamento = :data_lancamento, 
                        imagem_url = :imagem_url, 
                        descricao = :descricao
                    WHERE id = :id";
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':nome', $jogo->getNome());
            $query->bindValue(':categoria', $jogo->getCategoria());
            $query->bindValue(':plataforma', $jogo->getPlataforma());
            $query->bindValue(':desenvolvedor', $jogo->getDesenvolvedor());
            $query->bindValue(':data_lancamento', $jogo->getDataLancamento());
            $query->bindValue(':imagem_url', $jogo->getImagemUrl());
            $query->bindValue(':descricao', $jogo->getDescricao());
            $query->bindValue(':id', $jogo->getId(), PDO::PARAM_INT);
            return $query->execute();
        }

        public function deletar($id) {
            $sql = "DELETE FROM jogos WHERE id = :id";
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
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
