<!-- Page d'accueil -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-800">Bienvenue sur notre plateforme</h1>
        <p class="mt-4 text-gray-600">Connectez-vous pour accéder à votre espace</p>
        <div class="mt-6">
            <a href="router.php?action=login" class="px-6 py-2 bg-blue-500 text-white rounded-lg shadow">Se connecter</a>
            <a href="router.php?action=register" class="px-6 py-2 bg-green-500 text-white rounded-lg shadow">S'inscrire</a>
        </div>
    </div>
</body>
</html>