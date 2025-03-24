<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attribuer un Rôle</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center">Attribuer un Rôle</h2>

        <?php if (!empty($_SESSION["success"])): ?>
            <p class="text-green-500"><?= $_SESSION["success"]; unset($_SESSION["success"]); ?></p>
        <?php endif; ?>

        <?php if (!empty($_SESSION["error"])): ?>
            <p class="text-red-500"><?= $_SESSION["error"]; unset($_SESSION["error"]); ?></p>
        <?php endif; ?>

        <form action="router.php?action=assign_role&id=<?= $user['id']; ?>" method="post" class="mt-4">
            <div class="mb-4">
                <label class="block text-gray-700">Utilisateur :</label>
                <input type="text" value="<?= htmlspecialchars($user['username']); ?>" class="w-full px-3 py-2 border rounded-lg" disabled>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Rôle :</label>
                <select name="role_id" class="w-full px-3 py-2 border rounded-lg">
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id']; ?>" <?= ($user['role_id'] == $role['id']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($role['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg shadow">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
