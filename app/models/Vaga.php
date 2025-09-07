<?php
class Vaga {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM vagas");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar todas as vagas: " . $e->getMessage());
            return[];
        }
    }

    public function findById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM vagas WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar vaga pos ID:" . $e->getMessage());
            return false;
        }
    }

    public function findByEmpresaId($empresa_id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM vagas WHERE empresa_id = ?");
            $stmt->execute([$empresa_id]);
        } catch (PDOException $e) {
            error_log("Erro ao buscar vagas por empresa: ". $e->getMessage());
            return[];
        }
    }
    

    public function create($titulo, $descricao, $requisitos, $localizacao, $empresa_id) {
        try {
            $stmt = $this->conn->prepare("SELECT INTO vagas (titulo, descricao, requisitos, localizacao, empresa_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$titulo, $descricao, $requisitos, $localizacao, $empresa_id]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao criar vaga: ". $e->getMessage());
            return false;
        }
    }

    public function update($id, $titulo, $descricao, $requisitos, $localizacao) {
        try {
            $stmt = $this->conn->prepare("UPDATE vagas SET titulo = ?, descricao = ?, requisitos = ?, localizacao = ? WHERE id = ?");
            $stmt->execute([$titulo, $descricao, $requisitos, $localizacao, $id]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao atualizar vaga: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM vagas WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            error_log(("Erro ao deletar vaga: ". $e->getMessage()));
            return false;
        }
    }
}