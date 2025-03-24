<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Rôles</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 p-8">
    <h1 class="text-3xl font-bold mb-6">Gestion des Rôles</h1>

    <a href="router.php?action=create_role" class="px-4 py-2 bg-green-500 text-white rounded-lg">+ Ajouter un rôle</a>

    <table class="mt-6 w-full bg-white shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-4">ID</th>
                <th class="p-4">Nom du rôle</th>
                <th class="p-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role): ?>
                <tr class="border-t">
                    <td class="p-4"><?= $role['id']; ?></td>
                    <td class="p-4"><?= $role['name']; ?></td>
                    <td class="p-4">
                        <a href="router.php?action=edit_role&id=<?= $role['id']; ?>" class="text-blue-500"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="router.php?action=delete_role&id=<?= $role['id']; ?>" class="text-red-500 ml-4" onclick="return confirm('Supprimer ce rôle ?')"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
