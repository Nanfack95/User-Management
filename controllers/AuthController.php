<?php
require_once 'models/User.php';
require_once 'config/database.php';
require_once 'models/Log.php';
require_once 'config/security.php';

class AuthController {

    public function register() {
        global $db;
        $userModel = new User($db);
        $roles = $userModel->getRoles(); // Récupérer la liste des rôles

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = cleanInput(trim($_POST["username"]));
            $email = filter_var(cleanInput(trim($_POST["email"])), FILTER_VALIDATE_EMAIL);
            $password = cleanInput($_POST["password"]);
            $role_id = (int)$_POST["role_id"]; // Récupération du role_id

            if (!empty($username) && !empty($email) && !empty($password) && !empty($role_id)) {
                if ($userModel->register($username, $email, $password, $role_id)) {
                    $_SESSION["success"] = "Inscription réussie ! Connectez-vous.";
                    header("Location: router.php?action=login");
                    exit();
                } else {
                    $_SESSION["error"] = "Erreur lors de l'inscription.";
                }
            } else {
                $_SESSION["error"] = "Tous les champs sont requis.";
            }
        }
        require 'views/register.php';
    }

    public function login() {
        global $db;
        $sessionModel = new Log($db);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = filter_var(cleanInput(trim($_POST["email"])), FILTER_VALIDATE_EMAIL);
            $password = cleanInput($_POST["password"]);

            if (!empty($email) && !empty($password)) {
                $userModel = new User($db);
                $utilisateur = $userModel->getUserByEmail($email);
                $user = $userModel->login($email, $password);
                if ($user) {
                    $_SESSION["user_id"] = $user["id"];
                    $_SESSION["username"] = $user["username"];
                    $_SESSION["role"] = $user["role"];
                    $_SESSION["email"] = $user["email"];
                    $_SESSION["role_name"] = $user["role_name"];

                    $sessionModel->createSession($user["id"]);

                    if ($utilisateur["role_name"] === "Administrateur") {
                        header("Location: router.php?action=dashboard");
                    }  
                    if($utilisateur["role_name"] === "Client"){
                        header("Location: router.php?action=dashboard_client");
                    }
                    exit();
                } else {
                    $_SESSION["error"] = "Identifiants incorrects.";
                }
            } else {
                $_SESSION["error"] = "Tous les champs sont requis.";
            }
        }
        require 'views/login.php';
    }

    public function logout() {
        global $db;
        $sessionModel = new Log($db);

        $sessionModel->updateLogoutTime($_SESSION["user_id"]);
        session_destroy();
        header("Location: router.php?action=login");
        exit();
    }
}
?>
