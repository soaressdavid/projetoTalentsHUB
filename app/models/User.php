<?php

class User {
    private $conn ;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function findByEmail($email) {
        try {
            $stmt = $this->conn->prepare("SELECT id, nome, email, senha, tipo_usuario FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar usuário por email:" . $e->getMessage());
            return false;
        }
    }
}