<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center">Modifier l'utilisateur</h2>

        <form action="router.php?action=edit_user&id=<?= $user['id']; ?>"method="post" class="mt-4">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Nom :</label>
                <input type="text" id="username" name="username" value="<?= $user['username']; ?>" class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email :</label>
                <input type="email" id="email" name="email" value="<?= $user['email']; ?>" class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700">Rôle :</label>
                <select name="role_id" class="w-full px-3 py-2 border rounded-lg" required>
                    <option value="">-- Sélectionnez un rôle --</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id']; ?>" <?= ($user['role_id'] == $role['id']) ? 'selected' : ''; ?>>
                            <?= $role['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg shadow">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
