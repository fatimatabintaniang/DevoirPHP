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
    <?php require_once __DIR__ . "/./composant/navbar.html.php"; ?>
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-xl mt-24">
        <!-- En-tête avec titre et boutons -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Liste des Clients</h1>
            <div class="flex space-x-4">
                <!-- Bouton pour ouvrir le modal ajout de client -->
                <button onclick="openModal('addClientModal')"
                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-2 rounded-md shadow-lg hover:from-blue-600 hover:to-blue-700 transition duration-300 ease-in-out">
                    Ajouter un client
                </button>
                <!-- Bouton pour ouvrir le modal ajout de dette -->
                <button onclick="openModal('addDetteModal')"
                        class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-2 rounded-md shadow-lg hover:from-green-600 hover:to-green-700 transition duration-300 ease-in-out">
                    Ajouter une dette
                </button>
            </div>
        </div>

        <!-- Affichage des messages d'erreur -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Tableau des clients -->
        <div class="overflow-x-auto mt-10">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Nom</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Téléphone</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Adresse</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($client['nom']); ?></td>
                            <td class="px-6 py-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($client['telephone']); ?></td>
                            <td class="px-6 py-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($client['adresse']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal pour ajouter un client -->
        <div id="addClientModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center p-4">
            <div class="bg-white p-8 rounded-lg w-full max-w-md shadow-2xl transform transition-all duration-300 ease-in-out">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Ajouter un client</h2>
                <form method="POST" action="?controller=client&action=addClient" class="space-y-6">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom:</label>
                        <input type="text" id="nom" name="nom" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone:</label>
                        <input type="text" id="telephone" name="telephone" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse:</label>
                        <input type="text" id="adresse" name="adresse" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeModal('addClientModal')"
                                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-300 ease-in-out">
                            Annuler
                        </button>
                        <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal pour ajouter une dette -->
        <div id="addDetteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center p-4">
            <div class="bg-white p-8 rounded-lg w-full max-w-md shadow-2xl transform transition-all duration-300 ease-in-out">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Ajouter une dette</h2>
                <form method="POST" action="?controller=client&action=addDette" class="space-y-6">
                    <div>
                        <label for="client_id" class="block text-sm font-medium text-gray-700">Client:</label>
                        <select id="client_id" name="client_id" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <?php foreach ($clients as $client): ?>
                                <option value="<?php echo $client['id']; ?>"><?php echo $client['nom']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="montant" class="block text-sm font-medium text-gray-700">Montant:</label>
                        <input type="number" id="montant" name="montant" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date:</label>
                        <input type="date" id="date" name="date" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="etat" class="block text-sm font-medium text-gray-700">État:</label>
                        <select id="etat" name="etat" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="Solde">Solde</option>
                            <option value="Restant">Restant</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeModal('addDetteModal')"
                                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-300 ease-in-out">
                            Annuler
                        </button>
                        <button type="submit"
                                class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-300 ease-in-out">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Script pour gérer les modals -->
        <script>
            function openModal(modalId) {
                document.getElementById(modalId).classList.remove('hidden');
            }

            function closeModal(modalId) {
                document.getElementById(modalId).classList.add('hidden');
            }
        </script>
    </div>
</body>
</html>