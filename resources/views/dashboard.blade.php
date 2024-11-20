<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tableau de bord
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h3 class="text-xl mb-4">Bienvenue sur Panidel !</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @can('invite employees')
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h4 class="text-lg mb-2">Inviter un gestionnaire</h4>
                            <p class="mb-4">Inviter de nouveaux gestionnaires de commandes</p>
                            <a href="{{ route('users.create') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                                Inviter un utilisateur
                            </a>
                        </div>
                        @endcan

                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h4 class="text-lg mb-2">Passer une commande</h4>
                            <p class="mb-4">Choisissez parmi notre sélection de sandwichs</p>
                            <a href="{{ route('sandwiches.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition-all duration-300 transform hover:scale-105">
                                Commander maintenant ✨
                            </a>
                        </div>

                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h4 class="text-lg mb-2">Mes commandes</h4>
                            <p class="mb-4">Consultez l'historique de vos commandes</p>
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                                Voir l'historique
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
