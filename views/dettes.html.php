<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettes Non Soldées</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<?php require_once __DIR__ . "/./composant/navbar.html.php"; ?>
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-xl mt-10">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Dettes Non Soldées</h1>

        <!-- Formulaire de filtrage -->
        <form method="GET" action="<?=WEBROOT?>?controller=dette&page=dettes" class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone:</label>
                    <input type="text" id="telephone" name="telephone"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Filtrer par téléphone">
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date:</label>
                    <input type="date" id="date" name="date"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-end">
                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out">
                        Filtrer
                    </button>
                </div>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Client</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Montant</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Date</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">État</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dettes as $dette): ?>
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($dette['client_nom']); ?></td>
                            <td class="px-6 py-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($dette['montant']); ?></td>
                            <td class="px-6 py-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($dette['date']); ?></td>
                            <td class="px-6 py-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($dette['etat']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>