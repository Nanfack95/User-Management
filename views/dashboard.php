<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once 'models/User.php';
    require_once 'config/database.php';

    $userModel = new User($db);
    $user = $userModel->getUserById($_SESSION["user_id"]); // Récupérer les infos du client
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Client</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 min-h-screen flex">
    <aside class="bg-white w-64 p-4 flex flex-col">
        <div class="flex items-center mb-8">
            <i class="fa-solid fa-chart-pie text-blue-500 mr-2 text-2xl"></i>
            <span class="font-semibold text-lg">Tableau de Bord</span>
        </div>
        <nav class="flex-1">
            <a href="router.php?action=edit_profile" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                <i class="fas fa-user mr-2"></i> Modifier mon profil
            </a>
            <a href="router.php?action=history" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                <i class="fas fa-history mr-2"></i> Historique
            </a>
            <a href="router.php?action=logout" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
            </a>
        </nav>
    </aside>

    <main class="flex-1">
        <div class="h-full overflow-y-auto">
            <section class="bg-gradient-to-l from-purple-600 to-purple-800 text-white px-8 py-4 h-[230px] relative flex flex-col justify-center items-center">
                <div class="flex justify-center mb-8">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['username']); ?>&size=120&background=random" 
                        alt="Avatar" class="w-24 h-24 rounded-full shadow-md border-4 border-white">
                </div>
                <h2 class="text-4xl font-bold mb-4">Bienvenue, <?= htmlspecialchars($user['username']); ?> !</h2>
            </section>
            <div class="w-full bg-white shadow-lg p-8 mx-auto">
                <div class="space-y-6">
                    <div class="flex items-center justify-between border-b pb-4">
                        <span class="text-gray-700 font-medium">Nom :</span>
                        <span class="text-gray-800"><?= htmlspecialchars($user['username']); ?></span>
                    </div>
                    <div class="flex items-center justify-between border-b pb-4">
                        <span class="text-gray-700 font-medium">Email :</span>
                        <span class="text-gray-800"><?= htmlspecialchars($user['email']); ?></span>
                    </div>
                    <div class="flex items-center justify-between border-b pb-4">
                        <span class="text-gray-700 font-medium">Rôle :</span>
                        <span class="text-gray-800"><?= htmlspecialchars($user['role_name']); ?></span>
                    </div>
                    <div class="flex items-center justify-between border-b pb-4">
                        <span class="text-gray-700 font-medium">Statut :</span>
                        <span class="<?= $user['status'] === 'active' ? 'text-green-600 bg-green-100 px-3 py-1 rounded-full font-semibold text-sm' : 'text-red-600 bg-red-100 px-3 py-1 rounded-full font-semibold text-sm'; ?>">
                            <?= ucfirst($user['status']); ?>
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 font-medium">Date d'inscription :</span>
                        <span class="text-gray-800"><?= date("d/m/Y", strtotime($user['created_at'])); ?></span>
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 text-center text-sm text-gray-600 border-t">
                <div class="container mx-auto">
                    <p class="mb-1">&copy; 2020 Derouaz and Mostefa - Chebra (ESI ALGIERS)</p>
                    <p class="text-xs">ESI Algiers | About Us | Gen42 | MIT License</p>
                </div>
            </footer>
        </div>
        
    </main>
</body>
</html>