<?php
    require_once 'models/User.php';
    require_once 'config/database.php';
    require_once 'models/Log.php';
    session_start();
    
    class UserController{
        public function index() {
            global $db;
            $userModel = new User($db);
            $users = $userModel->getAllUsers();
            require 'views/users/index.php';
        }
    
        public function edit($id) {
            global $db;
            $userModel = new User($db);
            $roles = $userModel->getRoles(); // Récupérer tous les rôles
            $user = $userModel->getUserById($id); 
    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = htmlspecialchars(trim($_POST["username"]));
                $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
                $role_id = isset($_POST["role_id"]) ? (int) $_POST["role_id"] : 1; // 1 = rôle par défaut
                // $status = $_POST["status"];
    
                if ($userModel->updateUser($id, $username, $email, $role_id)) {
                    $_SESSION["success"] = "Utilisateur mis à jour avec succès.";
                    header("Location: router.php?action=users");
                    exit();
                } else {
                    $_SESSION["error"] = "Erreur lors de la mise à jour.";
                }
            }
    
            $user = $userModel->getUserById($id);
            require 'views/users/edit.php';
        }
    
        public function delete($id) {
            global $db;
            $userModel = new User($db);
    
            if ($userModel->deleteUser($id)) {
                $_SESSION["success"] = "Utilisateur supprimé avec succès.";
            } else {
                $_SESSION["error"] = "Erreur lors de la suppression.";
            }
    
            header("Location: router.php?action=users");
            exit();
        }

        public function toggleStatus($id) {
            global $db;
            $userModel = new User($db);
            $user = $userModel->getUserById($id);
        
            if ($user) {
                $newStatus = ($user['status'] === 'active') ? 'inactive' : 'active';
                $stmt = $db->prepare("UPDATE users SET status = ? WHERE id = ?");
                $stmt->execute([$newStatus, $id]);
        
                $_SESSION["success"] = "Le statut de l'utilisateur a été mis à jour.";
            } else {
                $_SESSION["error"] = "Utilisateur introuvable.";
            }
        
            header("Location: router.php?action=users");
            exit();
        }

        public function create() {
            global $db;
            $userModel = new User($db);
            $roles = $userModel->getRoles(); // Récupérer la liste des rôles
        
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = htmlspecialchars(trim($_POST["username"]));
                $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
                $password = $_POST["password"];
                $role_id = (int) $_POST["role_id"];
        
                if (!empty($username) && !empty($email) && !empty($password) && !empty($role_id)) {
                    if ($userModel->createUser($username, $email, $password, $role_id)) {
                        $_SESSION["success"] = "Utilisateur ajouté avec succès.";
                        header("Location: router.php?action=users");
                        exit();
                    } else {
                        $_SESSION["error"] = "Erreur lors de l'ajout.";
                    }
                } else {
                    $_SESSION["error"] = "Tous les champs sont requis.";
                }
            }
            require 'views/users/create.php';
        } 
        
        public function editProfile() {
            global $db;
            $userModel = new User($db);
            $user = $userModel->getUserById($_SESSION["user_id"]);
        
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = htmlspecialchars(trim($_POST["username"]));
                $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
                $password = !empty($_POST["password"]) ? $_POST["password"] : null;
        
                if (!empty($username) && !empty($email)) {
                    if ($userModel->updateProfile($_SESSION["user_id"], $username, $email, $password)) {
                        $_SESSION["success"] = "Profil mis à jour avec succès.";
                        $_SESSION["username"] = $username;
                        $_SESSION["email"] = $email;
                        header("Location: router.php?action=edit_profile");
                        exit();
                    } else {
                        $_SESSION["error"] = "Erreur lors de la mise à jour.";
                    }
                } else {
                    $_SESSION["error"] = "Tous les champs sont requis.";
                }
            }
            require 'views/edit_profil.php';
        }
        
        public function history() {
           global $db;
            $sessionModel = new Log($db);
            $logs = $sessionModel->getUserHistory($_SESSION["user_id"]);

            require 'views/history.php';
        }
        
        public function updateRole($id) {
            global $db;
            $userModel = new User($db);
            $roleModel = new Role($db);
            
            $user = $userModel->getUserById($id);
            $roles = $roleModel->getAllRoles(); // Récupérer tous les rôles disponibles
        
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $role_id = (int) $_POST["role_id"];
        
                if (!empty($role_id)) {
                    if ($userModel->updateUserRole($id, $role_id)) {
                        $_SESSION["success"] = "Rôle mis à jour avec succès.";
                        header("Location: router.php?action=users");
                        exit();
                    } else {
                        $_SESSION["error"] = "Erreur lors de la mise à jour du rôle.";
                    }
                } else {
                    $_SESSION["error"] = "Veuillez sélectionner un rôle.";
                }
            }
            require 'views/users/assign_role.php';
        }
        
    }

?>