<?php

namespace App\Models;

    class Usuario {

        private $id;
        private $nome;
        private $email;
        private $cpf;
        private $data_nascimento;
        private $celular;
        private $senha;
        private $tipo_usuario;

        public function __construct($id, $nome, $email, $cpf, $data_nascimento, $celular, $senha, $tipo_usuario) {
            $this->id = $id;
            $this->nome = $nome;
            $this->email = $email;
            $this->cpf = $cpf;
            $this->data_nascimento = $data_nascimento;
            $this->celular = $celular;
            $this->senha = $senha;
            $this->tipo_usuario = $tipo_usuario;
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

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->email = $email;
            } else {
                throw new \InvalidArgumentException("Email inválido.");
            }
        }

        public function getCpf() {
            return $this->cpf;
        }

        public function setCpf($cpf) {
            $this->cpf = $cpf;
        }

        public function getDataNascimento() {
            return $this->data_nascimento;
        }

        public function setDataNascimento($data_nascimento) {
            $this->data_nascimento = $data_nascimento;
        }

        public function getCelular() {
            return $this->celular;
        }

        public function setCelular($celular) {
            $this->celular = $celular;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function setSenha($senha) {
            $this->senha = $senha;
        }

        public function getTipoUsuario() {
            return $this->tipo_usuario;
        }

        public function setTipoUsuario($tipo_usuario) {
            $this->tipo_usuario = $tipo_usuario;
        }
    }
?>