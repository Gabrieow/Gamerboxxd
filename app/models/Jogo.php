<?php

namespace App\Models;

    class Jogo {
        private $id;
        private $nome;
        private $categoria;
        private $plataforma;
        private $desenvolvedor;
        private $data_lancamento;
        private $imagem_url;
        private $descricao;

        public function __construct($id, $nome, $categoria, $plataforma, $desenvolvedor, $data_lancamento, $imagem_url, $descricao) {
            $this->id = $id;
            $this->nome = $nome;
            $this->categoria = $categoria;
            $this->plataforma = $plataforma;
            $this->desenvolvedor = $desenvolvedor;
            $this->data_lancamento = $data_lancamento;
            $this->imagem_url = $imagem_url;
            $this->descricao = $descricao;
        }

        public function getId() {
            return $this->id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getCategoria() {
            return $this->categoria;
        }

        public function setCategoria($categoria) {
            $this->categoria = $categoria;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function getPlataforma() {
            return $this->plataforma;
        }

        public function setPlataforma($plataforma) {
            $this->plataforma = $plataforma;
        }

        public function getDesenvolvedor() {
            return $this->desenvolvedor;
        }

        public function setDesenvolvedor($desenvolvedor) {
            $this->desenvolvedor = $desenvolvedor;
        }

        public function getDataLancamento() {
            return $this->data_lancamento;
        }

        public function setDataLancamento($data_lancamento) {
            $this->data_lancamento = $data_lancamento;
        }

        public function getImagemUrl() {
            return $this->imagem_url;
        }

        public function setImagemUrl($imagem_url) {
            $this->imagem_url = $imagem_url;
        }
    }
?>