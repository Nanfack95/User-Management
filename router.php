<?php
require_once 'controllers/AdminController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/RoleController.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        require 'views/default.php';
        break;
    case 'dashboard':
        (new AdminController())->dashboard();
        break;
    case 'dashboard_client':
        require 'views/dashboard.php';
        break;
    case 'register':
        (new AuthController())->register();
        break;
    case 'login':
        (new AuthController())->login();
        break; 
    case 'logout':
        (new AuthController())->logout();
        break;
    case 'users':
        (new UserController())->index();
        break;
    case 'edit_user':
        (new UserController())->edit($_GET['id']);
        break;
    case 'delete_user':
        (new UserController())->delete($_GET['id']);
        break; 
    case 'toggle_status':
        (new UserController())->toggleStatus($_GET['id']);
        break;
    case 'create_user':
        (new UserController())->create();
        break;
    case 'edit_profile':
        (new UserController())->editProfile();
        break;
    case 'history':
        (new UserController())->history();
        break;
    case 'roles':
        (new RoleController())->index();
        break;
        
    case 'create_role':
        (new RoleController())->create();
        break;
        
    case 'edit_role':
        (new RoleController())->edit($_GET['id']);
        break;
        
    case 'delete_role':
        (new RoleController())->delete($_GET['id']);
        break;
    case 'assign_role':
        (new UserController())->updateRole($_GET['id']);
        break;             
    default:
        require 'views/404.php';
        break;
    // Autres routes...
}
?>
