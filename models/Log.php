<?php
class Log {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Nombre total de connexions enregistrées
    public function countLogs() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM sessions");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Nombre de connexions réussies (utilisateurs connectés)
    public function countSuccessfulLogins() {
        $stmt = $this->db->prepare("SELECT COUNT(DISTINCT user_id) as total FROM sessions WHERE logout_time IS NULL");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Nombre de connexions terminées (déconnexions enregistrées)
    public function countFailedLogins() {
        $stmt = $this->db->prepare("SELECT COUNT(DISTINCT user_id) as total FROM sessions WHERE logout_time IS NOT NULL");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Enregistrer une nouvelle connexion
    public function createSession($user_id) {
        $stmt = $this->db->prepare("INSERT INTO sessions (user_id) VALUES (?)");
        return $stmt->execute([$user_id]);
    }

    // Mettre à jour `logout_time` lors de la déconnexion
    public function updateLogoutTime($user_id) {
        $stmt = $this->db->prepare("UPDATE sessions SET logout_time = NOW() WHERE user_id = ? AND logout_time IS NULL");
        return $stmt->execute([$user_id]);
    }

    // Récupérer l'historique des connexions d'un utilisateur
    public function getUserHistory($user_id) {
        $stmt = $this->db->prepare("SELECT login_time, logout_time FROM sessions WHERE user_id = ? ORDER BY login_time DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
