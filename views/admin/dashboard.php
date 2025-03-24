<?php
require_once 'models/User.php';
require_once 'config/database.php';

$userModel = new User($db);
$users = $userModel->getLatestUsers() ?? []; // Assurez-vous que $users est un tableau
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

    <div class="bg-gray-100 h-screen overflow-hidden">
        <div class="flex h-screen">
            <aside class="bg-white w-64 p-4 flex flex-col">
                <div class="flex items-center mb-8">
                    <i class="fa-solid fa-chart-pie text-blue-500 mr-2 text-2xl"></i>
                    <span class="font-semibold text-lg">Social Analysis</span>
                </div>
                <nav class="flex-1">
                    <a href="router.php?action=dashboard" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 bg-gray-200">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                    <a href="router.php?action=users" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                        <i class="fas fa-file-alt mr-2"></i> Gestion Utilisateurs
                    </a>
                    <a href="router.php?action=roles" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                        <i class="fas fa-user mr-2"></i> Gestion Roles
                    </a>
                    <a href="router.php?action=logs" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 ">
                        <i class="fas fa-users mr-2"></i> Gestion Sessions
                    </a>
                    <a href="router.php?action=logout" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-sign-out-alt mr-2"></i> Deconnexion
                    </a>
                </nav>
            </aside>

            <main class="flex-1">
                <div class="h-full overflow-y-auto">
                    <section class="relative">
                        <section class="bg-gradient-to-l from-purple-600 to-purple-800 text-white px-8 py-4 h-[300px] relative">
                            <header class="flex justify-between items-center mb-8">
                                <h1 class="text-xl font-semibold uppercase">Gestion utilisateurs</h1>
                                <div class="flex items-center">
                                    <span class="text-white mr-4">
                                        <i class="fas fa-bell text-blue-500 mr-2"></i> Notifications
                                    </span>
                                    <div>
                                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['username']); ?>&size=120&background=random" 
                                        alt="Avatar" class="w-10 h-10 rounded-full shadow-md border-4 border-white">
                                    </div>&nbsp;&nbsp;
                                    <span class="font-semibold capitalize text-xl"><?= htmlspecialchars($_SESSION['username']); ?></span>
                                </div>
                            </header>
                            <h2 class="text-3xl font-bold mb-4">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </h2>
                        </section>

                        <section class="bg-white rounded-lg p-8 m-8 absolute top-40 w-[95%] shadow-md">
                            <div class="flex justify-between items-center mb-8">
                                <h3 class="text-xl font-semibold">Les Chiffres Cles</h3>
                            </div>

                            <div class="grid grid-cols-4 gap-4">
                                <div class="bg-gray-100  rounded-md px-4 py-2 inline-block">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-[16px] font-semibold">Nombres<br>d'utilisateurs</h2>
                                        <i class="fas fa-user text-3xl mb-2"></i>  
                                    </div>
                                    <p class="font-semibold text-lg text-gray-800"><?= isset($totalUsers) ? $totalUsers : 'N/A'; ?></p>
                                </div>
                                <div class="bg-gray-100  rounded-md px-4 py-2 inline-block">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-[16px] font-semibold">Nombres<br>Rôles</h2>
                                        <i class="fas fa-user text-3xl mb-2"></i>  
                                    </div>
                                    <p><?= isset($totalRoles) ? $totalRoles : 'N/A'; ?></p>
                                </div>
                                <div class="bg-gray-100  rounded-md px-4 py-2 inline-block">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-[16px] font-semibold">Nombres<br>Logs</h2>
                                        <i class="fas fa-user text-3xl mb-2"></i>  
                                    </div>
                                    <p><?= isset($totalLogs) ? $totalLogs : 'N/A'; ?></p>
                                </div>
                                <div class="bg-gray-100  rounded-md px-4 py-2 inline-block">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-[16px] font-semibold">Utilisateurs Actifs</h2>
                                        <i class="fas fa-user text-3xl mb-2"></i>  
                                    </div>
                                    <p><?= isset($totalActiveUsers) ? $totalActiveUsers : 'N/A'; ?></p>
                                </div>
                                <div class="bg-gray-100  rounded-md px-4 py-2 inline-block">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-[16px] font-semibold">Utilisateurs Inactifs</h2>
                                        <i class="fas fa-user text-3xl mb-2"></i>  
                                    </div>
                                    <p><?= isset($totalInactiveUsers) ? $totalInactiveUsers : 'N/A'; ?></p>
                                </div>
                                <div class="bg-gray-100  rounded-md px-4 py-2 inline-block">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-[16px] font-semibold">Connexions Réussies</h2>
                                        <i class="fas fa-user text-3xl mb-2"></i>  
                                    </div>
                                    <p><?= isset($successfulLogins) ? $successfulLogins : 'N/A'; ?></p>
                                </div>
                                <div class="bg-gray-100  rounded-md px-4 py-2 inline-block">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-[16px] font-semibold">Connexions Échouées</h2>
                                        <i class="fas fa-user text-3xl mb-2"></i>  
                                    </div>
                                    <p><?= isset($failedLogins) ? $failedLogins : 'N/A'; ?></p>
                                </div>
                            </div>
                        </section>
                        <section class=" relative mt-[18rem] m-8">
                            <h2 class="text-2xl font-semibold mb-6">Statistiques</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-white rounded-lg p-6 shadow-md">
                                    <h3 class="text-lg font-semibold mb-4">Répartition des Utilisateurs</h3>
                                    <canvas id="userChart" class="w-full h-30"></canvas>
                                </div>
                                <div class="bg-white rounded-lg p-6 shadow-md">
                                    <h3 class="text-lg font-semibold mb-4">Statistiques des Connexions</h3>
                                    <canvas id="loginChart" class="w-full h-30"></canvas>
                                </div>
                                <div class="bg-white rounded-lg p-6 shadow-md">
                                    <h3 class="text-lg font-semibold mb-4"> Évolution des Connexions</h3>
                                    <canvas id="loginTrendChart" class="w-full h-30"></canvas>
                                </div>
                            </div>
                        </section>
                        <section id="manage-profile" class=" bg-white rounded-lg p-8 m-8">
                            <h2 class="text-2xl font-semibold mb-4">Gestion des Utilisateurs</h2>
                            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                                <thead class="bg-gray-100">
                                    <tr class="text-left">
                                        <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider">Nom</th>
                                        <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider">Rôle</th>
                                        <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider">Statut</th>
                                        <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr class="border-b hover:bg-gray-200 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><?= $user['username']; ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><?= $user['email']; ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><?= $user['role_name']; ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <span class="<?= $user['status'] === 'active' ? 'text-green-600 bg-green-100 px-2 py-1 rounded-full text-xs font-semibold' : 'text-red-600 bg-red-100 px-2 py-1 rounded-full text-xs font-semibold'; ?>">
                                                    <?= ucfirst($user['status']); ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="router.php?action=edit_user&id=<?= $user['id']; ?>" class="text-blue-600 hover:text-blue-800 transition-colors duration-200"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="router.php?action=toggle_status&id=<?= $user['id']; ?>" class="text-yellow-600 hover:text-yellow-800 ml-4 transition-colors duration-200">
                                                    <?= $user['status'] === 'active' ? '<i class="fa-solid fa-lock-open"></i>' : '<i class="fa-solid fa-user-lock"></i>'; ?>
                                                </a>
                                                <a href="router.php?action=delete_user&id=<?= $user['id']; ?>" class="text-red-600 hover:text-red-800 ml-4 transition-colors duration-200" onclick="return confirm('Supprimer cet utilisateur ?')"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </section>
                    </section>
                    <footer class="bg-gray-100 py-4 text-center text-sm text-gray-600 border-t">
                        <div class="container mx-auto">
                            <p class="mb-1">&copy; 2020 Derouaz and Mostefa - Chebra (ESI ALGIERS)</p>
                            <p class="text-xs">ESI Algiers | About Us | Gen42 | MIT License</p>
                        </div>
                    </footer>
                </div>
                </div>
            </main>
        </div>
        
    </div>

    <!-- <script>
            // Graphique des utilisateurs actifs
            new Chart(document.getElementById('activeUsersChart'), {
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                    datasets: [{
                        label: 'Utilisateurs actifs',
                        data: [12, 19, 3, 5, 2, 3, 7],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Graphique des nouvelles inscriptions
            new Chart(document.getElementById('newRegistrationsChart'), {
                type: 'bar',
                data: {
                    labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                    datasets: [{
                        label: 'Nouvelles inscriptions',
                        data: [5, 10, 8, 12, 6, 4, 9],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Graphique des pages les plus vues
            new Chart(document.getElementById('mostViewedPagesChart'), {
                type: 'pie',
                data: {
                    labels: ['Accueil', 'Profil', 'Paramètres', 'Articles'],
                    datasets: [{
                        label: 'Pages les plus vues',
                        data: [30, 20, 15, 35],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 206, 86)',
                            'rgb(75, 192, 192)'
                        ],
                        hoverOffset: 4
                    }]
                }
            });
    </script> -->
    <script>
        // Données PHP envoyées en JavaScript
        const totalActiveUsers = <?= $totalActiveUsers ?? 0; ?>;
        const totalInactiveUsers = <?= $totalInactiveUsers ?? 0; ?>;
        const successfulLogins = <?= $successfulLogins ?? 0; ?>;
        const failedLogins = <?= $failedLogins ?? 0; ?>;
        const last7DaysLabels = <?= json_encode($last7DaysLabels ?? []); ?>;
        const last7DaysData = <?= json_encode($last7DaysData ?? []); ?>;

        function isDataAvailable(data) {
            return data.some(value => value > 0);
        }

        // 1️⃣ Graphique en Pie Chart (Utilisateurs Actifs/Inactifs)
        if (isDataAvailable([totalActiveUsers, totalInactiveUsers])) {
            new Chart(document.getElementById('userChart').getContext('2d'), {
                type: 'pie',
                data: {
                    labels: ['Actifs', 'Inactifs'],
                    datasets: [{
                        data: [totalActiveUsers, totalInactiveUsers],
                        backgroundColor: ['#4CAF50', '#F44336']
                    }]
                }
            });
        } else {
            document.getElementById('userChart').outerHTML = "<p class='text-center text-gray-500'>Aucune donnée utilisateur.</p>";
        }

        // 2️⃣ Graphique en Bar Chart (Connexions réussies/échouées)
        if (isDataAvailable([successfulLogins, failedLogins])) {
            new Chart(document.getElementById('loginChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Réussies', 'Échouées'],
                    datasets: [{
                        data: [successfulLogins, failedLogins],
                        backgroundColor: ['#2196F3', '#FF5722']
                    }]
                }
            });
        } else {
            document.getElementById('loginChart').outerHTML = "<p class='text-center text-gray-500'>Aucune connexion enregistrée.</p>";
        }

        // 3️⃣ Graphique en Line Chart (Évolution des connexions)
        if (last7DaysLabels.length > 0) {
            new Chart(document.getElementById('loginTrendChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: last7DaysLabels,
                    datasets: [{
                        label: 'Connexions',
                        data: last7DaysData,
                        borderColor: '#FF9800',
                        fill: false
                    }]
                }
            });
        } else {
            document.getElementById('loginTrendChart').outerHTML = "<p class='text-center text-gray-500'>Aucune donnée récente.</p>";
        }
    </script>
</body>
</html>