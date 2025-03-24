<?php
class Role {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function countRoles() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM roles");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Récupérer tous les rôles
    public function getAllRoles() {
        $stmt = $this->db->query("SELECT * FROM roles ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un rôle
    public function addRole($name) {
        $stmt = $this->db->prepare("INSERT INTO roles (name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    // Modifier un rôle
    public function updateRole($id, $name) {
        $stmt = $this->db->prepare("UPDATE roles SET name = ? WHERE id = ?");
        return $stmt->execute([$name, $id]);
    }

    // Supprimer un rôle
    public function deleteRole($id) {
        $stmt = $this->db->prepare("DELETE FROM roles WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Récupérer un rôle par son ID
    public function getRoleById($id) {
        $stmt = $this->db->prepare("SELECT * FROM roles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>