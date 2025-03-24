<?php
class User {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function countUsers() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM users");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function countActiveUsers() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM users WHERE status = 'active'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function countInactiveUsers() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM users WHERE status = 'inactive'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    
    // Récupérer la liste des rôles existants
    public function getRoles() {
        $stmt = $this->db->query("SELECT * FROM roles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inscription d'un nouvel utilisateur
    public function register($username, $email, $password, $role_id) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, role_id, status) VALUES (?, ?, ?, ?, 'active')");
        return $stmt->execute([$username, $email, $hashedPassword, $role_id]);
    }

    // Vérification des identifiants pour la connexion
    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Retourne l'utilisateur si le mot de passe est correct
        }
        return false;
    }

    // Récupérer tous les utilisateurs
    public function getAllUsers() {
        $stmt = $this->db->query("SELECT users.*, roles.name AS role_name FROM users LEFT JOIN roles ON users.role_id = roles.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLatestUsers($limit = 5) {
        $stmt = $this->db->prepare("
            SELECT users.*, roles.name AS role_name 
            FROM users 
            LEFT JOIN roles ON users.role_id = roles.id
            ORDER BY users.created_at DESC 
            LIMIT ?
        ");
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un utilisateur par ID
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT users.*, roles.name AS role_name FROM users LEFT JOIN roles ON users.role_id = roles.id WHERE users.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer un utilisateur par email
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("
            SELECT users.*, roles.name AS role_name 
            FROM users 
            LEFT JOIN roles ON users.role_id = roles.id 
            WHERE users.email = ?
        ");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour un utilisateur
    public function updateUser($id, $username, $email, $role_id) {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, role_id = ?, status ='active' WHERE id = ?");
        return $stmt->execute([$username, $email, $role_id, $id]);
    }

    // Supprimer un utilisateur
    public function deleteUser($id) {
        // Supprimer d'abord les sessions associées
        $stmt = $this->db->prepare("DELETE FROM sessions WHERE user_id = ?");
        $stmt->execute([$id]);
        // Supprimer l'utilisateur
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function createUser($username, $email, $password, $role_id) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, role_id, status, created_at) VALUES (?, ?, ?, ?, 'active', NOW())");
        return $stmt->execute([$username, $email, $hashedPassword, $role_id]);
    }

    public function updateProfile($id, $username, $email, $password = null) {
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
            return $stmt->execute([$username, $email, $hashedPassword, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
            return $stmt->execute([$username, $email, $id]);
        }
    }

    public function getUserHistory($user_id) {
        $stmt = $this->db->prepare("
            SELECT login_time, logout_time 
            FROM sessions 
            WHERE user_id = ? 
            ORDER BY login_time DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function updateUserRole($user_id, $role_id) {
        $stmt = $this->db->prepare("UPDATE users SET role_id = ? WHERE id = ?");
        return $stmt->execute([$role_id, $user_id]);
    }
    
}
?>
