<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center">Ajouter un utilisateur</h2>

        <form action="router.php?action=create_user" method="post" class="mt-4">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Nom :</label>
                <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email :</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg">
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
                <label for="role" class="block text-gray-700">Rôle :</label>
                <select name="role_id" class="w-full px-3 py-2 border rounded-lg" required>
                    <option value="">-- Sélectionnez un rôle --</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id']; ?>"><?= $role['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg shadow">Créer</button>
        </form>
    </div>

    <script>
        const motDePasse = document.getElementById('password');
        const voirMotDePasse = document.getElementById('eye-icon');
        const cacherMotDePasse = document.getElementById('eye-slash-icon');

        voirMotDePasse.addEventListener('click', function() {
            if (motDePasse.type === 'password') {
                motDePasse.type = 'text';
                voirMotDePasse.classList.add('hidden');
                cacherMotDePasse.classList.remove('hidden');
            }
        });

        cacherMotDePasse.addEventListener('click', function() {
            if (motDePasse.type === 'text') {
                motDePasse.type = 'password';
                cacherMotDePasse.classList.add('hidden');
                voirMotDePasse.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
