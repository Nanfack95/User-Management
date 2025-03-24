<?php
require_once 'models/User.php';
require_once 'models/Role.php';
require_once 'models/Log.php';
require_once 'config/database.php';

class AdminController {
    
    
    public function dashboard() {
        global $db;
        $userModel = new User($db);
        $roleModel = new Role($db);
        $logModel = new Log($db);

        $totalUsers = $userModel->countUsers();
        $totalActiveUsers = $userModel->countActiveUsers();
        $totalInactiveUsers = $userModel->countInactiveUsers();
        $totalRoles = $roleModel->countRoles();
        $totalLogs = $logModel->countLogs();
        $successfulLogins = $logModel->countSuccessfulLogins();
        $failedLogins = $logModel->countFailedLogins();

        $loginTrends = $this->getLast7DaysLogins();
        $last7DaysLabels = $loginTrends['labels'] ?? [];
        $last7DaysData = $loginTrends['data'] ?? [];
        require 'views/admin/dashboard.php';
    }

    public function getLast7DaysLogins() {
        global $db;
        
        $stmt = $db->prepare("
            SELECT DATE(login_time) as day, COUNT(*) as count 
            FROM sessions 
            WHERE login_time >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
            GROUP BY DATE(login_time)
        ");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Transformer les données pour Chart.js
        $labels = [];
        $counts = [];
        foreach ($data as $row) {
            $labels[] = $row['day'];
            $counts[] = $row['count'];
        }
    
        return ['labels' => $labels, 'data' => $counts];
    }
}
?>
