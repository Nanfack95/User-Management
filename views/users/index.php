<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <h1 class="text-3xl font-bold mb-6">Gestion des Utilisateurs</h1>
    <div class="flex justify-center items-center mb-6">
        <?php if (!empty($_SESSION["success"])): ?>
            <p class="text-green-500"><?= $_SESSION["success"]; unset($_SESSION["success"]); ?></p>
        <?php endif; ?>
    </div>
    <a href="router.php?action=create_user" class="px-4 py-2 bg-green-500 text-white rounded-lg">+ Ajouter un utilisateur</a>

    <table class="mt-6 w-full bg-white shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider">Nom</th>
                <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider">Rôle</th>
                <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider">Update</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr class="border-b hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-800"><?= $user['id']; ?></td>
                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-800"><?= $user['username']; ?></td>
                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-800"><?= $user['email']; ?></td>
                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-800"><?= $user['role_name']; ?></td>
                    <td class="px-8 py-4 whitespace-nowrap text-sm">
                        <span class="<?= $user['status'] === 'active' ? 'text-green-600 bg-green-100 px-2 py-1 rounded-full text-xs font-semibold' : 'text-red-600 bg-red-100 px-2 py-1 rounded-full text-xs font-semibold'; ?>">
                            <?= ucfirst($user['status']); ?>
                        </span>
                    </td>
                    <td class="px-8 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="router.php?action=edit_user&id=<?= $user['id']; ?>" class="text-blue-600 hover:text-blue-800 transition-colors duration-200"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="router.php?action=toggle_status&id=<?= $user['id']; ?>" class="text-yellow-600 hover:text-yellow-800 ml-4 transition-colors duration-200">
                            <?= $user['status'] === 'active' ? '<i class="fa-solid fa-lock-open"></i>' : '<i class="fa-solid fa-user-lock"></i>'; ?>
                        </a>
                        <a href="router.php?action=delete_user&id=<?= $user['id']; ?>" class="text-red-600 hover:text-red-800 ml-4 transition-colors duration-200" onclick="return confirm('Supprimer cet utilisateur ?')"><i class="fa-solid fa-trash"></i></a>
                    </td>
                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-800"">
                        <a href="router.php?action=assign_role&id=<?= $user['id']; ?>" class="text-blue-500">Modifier le rôle</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
