<?php

namespace App\Models;

    class Comentario {

        private $id;
        private $id_review;
        private $id_usuario;
        private $texto;
        private $data;

        public function __construct($id, $id_review, $id_usuario, $texto, $data) {
            $this->id = $id;
            $this->id_review = $id_review;
            $this->id_usuario = $id_usuario;
            $this->texto = $texto;
            $this->data = $data;
        }

        public function getId() {
            return $this->id;
        }

        public function getIdReview() {
            return $this->id_review;
        }

        public function setIdReview($id_review) {
            $this->id_review = $id_review;
        }

        public function getIdUsuario() {
            return $this->id_usuario;
        }

        public function setIdUsuario($id_usuario) {
            $this->id_usuario = $id_usuario;
        }

        public function getTexto() {
            return $this->texto;
        }

        public function setTexto($texto) {
            $this->texto = $texto;
        }

        public function getData() {
            return $this->data;
        }

        public function setData($data) {
            $this->data = $data;
        }
    }
?>
