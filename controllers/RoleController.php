<?php
require_once 'models/Role.php';
require_once 'config/database.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class RoleController {
    public function index() {
        global $db;
        $roleModel = new Role($db);
        $roles = $roleModel->getAllRoles();
        require 'views/roles/index.php';
    }

    public function create() {
        global $db;
        $roleModel = new Role($db);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = trim($_POST["name"]);
            if (!empty($name)) {
                if ($roleModel->addRole($name)) {
                    $_SESSION["success"] = "Rôle ajouté avec succès.";
                    header("Location: router.php?action=roles");
                    exit();
                } else {
                    $_SESSION["error"] = "Erreur lors de l'ajout.";
                }
            } else {
                $_SESSION["error"] = "Le champ est requis.";
            }
        }
        require 'views/roles/form.php';
    }

    public function edit($id) {
        global $db;
        $roleModel = new Role($db);
        $role = $roleModel->getRoleById($id);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = trim($_POST["name"]);
            if (!empty($name)) {
                if ($roleModel->updateRole($id, $name)) {
                    $_SESSION["success"] = "Rôle mis à jour.";
                    header("Location: router.php?action=roles");
                    exit();
                } else {
                    $_SESSION["error"] = "Erreur lors de la mise à jour.";
                }
            } else {
                $_SESSION["error"] = "Le champ est requis.";
            }
        }
        require 'views/roles/form.php';
    }

    public function delete($id) {
        global $db;
        $roleModel = new Role($db);
        if ($roleModel->deleteRole($id)) {
            $_SESSION["success"] = "Rôle supprimé avec succès.";
        } else {
            $_SESSION["error"] = "Erreur lors de la suppression.";
        }
        header("Location: router.php?action=roles");
        exit();
    }
}
