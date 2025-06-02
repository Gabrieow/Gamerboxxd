<?php

namespace App\Models;

    class Review {

        private $id;
        private $id_usuario;
        private $id_jogo;
        private $nota;
        private $comentario;
        private $data_review;

        public function __construct($id, $id_usuario, $id_jogo, $nota, $comentario, $data_review) {
            $this->id = $id;
            $this->id_usuario = $id_usuario;
            $this->id_jogo = $id_jogo;
            $this->nota = $nota;
            $this->comentario = $comentario;
            $this->data_review = $data_review;
        }

        public function getId() {
            return $this->id;
        }

        public function getIdUsuario() {
            return $this->id_usuario;
        }

        public function setIdUsuario($id_usuario) {
            $this->id_usuario = $id_usuario;
        }

        public function getIdJogo() {
            return $this->id_jogo;
        }

        public function setIdJogo($id_jogo) {
            $this->id_jogo = $id_jogo;
        }

        public function getNota() {
            return $this->nota;
        }

        public function setNota($nota) {
            $this->nota = $nota;
        }

        public function getComentario() {
            return $this->comentario;
        }

        public function setComentario($comentario) {
            $this->comentario = $comentario;
        }

        public function getDataReview() {
            return $this->data_review;
        }

        public function setDataReview($data_review) {
            $this->data_review = $data_review;
        }
    }
?>