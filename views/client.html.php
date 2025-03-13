<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <!-- Intégration de Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-8">Liste des Clients</h1>

        <!-- Affichage des messages d'erreur -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Conteneur pour aligner le tableau et le formulaire -->
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Tableau des clients -->
            <div class="flex-1 overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700">ID</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700">Nom</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700">Prénom</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700">Adresse</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clients as $client): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 border-b border-gray-200"><?php echo htmlspecialchars($client['id']); ?></td>
                                <td class="px-6 py-4 border-b border-gray-200"><?php echo htmlspecialchars($client['nom']); ?></td>
                                <td class="px-6 py-4 border-b border-gray-200"><?php echo htmlspecialchars($client['prenom']); ?></td>
                                <td class="px-6 py-4 border-b border-gray-200"><?php echo htmlspecialchars($client['adresse']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>


            <!-- Formulaire pour ajouter un nouveau client -->
<div class="flex-1">
    <h2 class="text-2xl font-bold mb-4">Ajouter un nouveau client</h2>
    <form method="POST" action="" class="space-y-4">
        <div>
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom:</label>
            <input type="text" id="nom" name="nom" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="prenom" class="block text-sm font-medium text-gray-700">Prenom:</label>
            <input type="text" id="prenom" name="prenom" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse:</label>
            <input type="text" id="adresse" name="adresse" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Ajouter
        </button>
    </form>
</div>

        </div>
    </div>
</body>
</html>