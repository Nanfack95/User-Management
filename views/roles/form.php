<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer/Modifier un Rôle</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center">
            <?= isset($role) ? 'Modifier le Rôle' : 'Créer un Rôle'; ?>
        </h2>

        <form action="router.php?action=<?= isset($role) ? 'edit_role&id=' . $role['id'] : 'create_role'; ?>" method="post" class="mt-4">
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nom du Rôle :</label>
                <input type="text" id="name" name="name" value="<?= $role['name'] ?? ''; ?>" class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg shadow">
                <?= isset($role) ? 'Mettre à jour' : 'Créer'; ?>
            </button>
        </form>
    </div>
</body>
</html>
