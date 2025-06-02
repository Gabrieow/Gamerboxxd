<?php

namespace App\Models;

    class Curtida {

        private $id;
        private $id_review;
        private $id_usuario;
        private $data;

        public function __construct($id, $id_review, $id_usuario, $data) {
            $this->id = $id;
            $this->id_review = $id_review;
            $this->id_usuario = $id_usuario;
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

        public function getData() {
            return $this->data;
        }

        public function setData($data) {
            $this->data = $data;
        }
    }
?>
