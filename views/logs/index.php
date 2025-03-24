<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Connexions</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <h1 class="text-3xl font-bold mb-6">Historique des Connexions</h1>

    <table class="w-full bg-white shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-4">ID</th>
                <th class="p-4">Utilisateur</th>
                <th class="p-4">Adresse IP</th>
                <th class="p-4">Date et Heure de Connexion</th>
                <th class="p-4">Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
                <tr class="border-t">
                    <td class="p-4"><?= $log['id']; ?></td>
                    <td class="p-4"><?= $log['username']; ?></td>
                    <td class="p-4"><?= $log['ip_address']; ?></td>
                    <td class="p-4"><?= $log['login_time']; ?></td>
                    <td class="p-4">
                        <span class="<?= $log['status'] === 'success' ? 'text-green-500' : 'text-red-500'; ?>">
                            <?= $log['status'] === 'success' ? 'Réussie' : 'Échouée'; ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
