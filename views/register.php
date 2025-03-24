<!-- Formulaire d'inscription -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet">
    <script src="/public/js/script.js" defer ></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="absolute top-4 text-center">
        <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        ?>
        <?php if (!empty($_SESSION["error"])): ?>
            <p class="text-red-500"><?= $_SESSION["error"]; unset($_SESSION["error"]); ?></p>
        <?php endif; ?>
        <?php if (!empty($_SESSION["success"])): ?>
            <p class="text-green-500"><?= $_SESSION["success"]; unset($_SESSION["success"]); ?></p>
        <?php endif; ?>
    </div>
    <div class="flex bg-white shadow-md rounded-lg overflow-hidden w-full max-w-4xl">
        <div class="w-1/2 bg-blue-500 flex items-center justify-center p-6">
            <img src="public/img/_removalai_preview.png" alt="Illustration" class="rounded-lg">
        </div>
        <div class="w-1/2 p-6">
            <h2 class="text-2xl font-semibold text-center">Créer un compte</h2>
            <form action="router.php?action=register" method="post" class="mt-4" id="registerForm">
                <div class="mb-4">
                    <label for="username" class="block text-sm/6 font-medium text-gray-900">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                    <input type="email" id="email" name="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
                <div class="mb-4 relative">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Mot de passe</label>
                    <input type="password" id="password" name="password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <span class="absolute inset-y-0 right-0 pr-3 pt-5 flex items-center cursor-pointer">
                        <span class=" h-5 w-5 text-gray-400" id="eye-icon"><i class="fa-solid fa-eye" ></i></span> 
                        <span class="hidden h-5 w-5 text-gray-400" id="eye-slash-icon"><i class="fa-solid fa-eye-slash"></i></span>
                    </span>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-sm/6 font-medium text-gray-900">Choisir un rôle</label>
                    <select id="role_id" name="role_id" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option value="">-- Sélectionnez un rôle --</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role['id']; ?>"><?= $role['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">S'inscrire</button>
                </div>
            </form>
            <p class="mt-10 text-center text-sm/6 text-gray-500">Deja inscrit sur notre site?
                <a href="router.php?action=login" class="font-semibold text-indigo-600 hover:text-indigo-500">Connectez-vous</a>
            </p>
        </div>
    </div>
    <script src="public/js/script.js"></script>
</body>
</html>