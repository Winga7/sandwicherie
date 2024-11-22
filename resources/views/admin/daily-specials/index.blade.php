<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Gestion des promotions
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Formulaire d'ajout -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Ajouter une promotion</h3>
                    <form action="{{ route('admin.daily-specials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-input-label for="title" value="Titre" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Description" />
                            <textarea id="description" name="description"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="price" value="Prix (optionnel)" />
                            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="image" value="Image (optionnel)" />
                            <input type="file" id="image" name="image" accept="image/*"
                                class="mt-1 block w-full text-gray-900 dark:text-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <x-primary-button @class(['!bg-blue-600 hover:!bg-blue-700'])>
                            Ajouter la promotion
                        </x-primary-button>
                    </form>
                </div>
            </div>

            <!-- Liste des promotions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Promotions actuelles</h3>
                    <div class="space-y-4">
                        @forelse($dailySpecials as $special)
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    @if($special->image_path)
                                        <img src="{{ asset('storage/' . $special->image_path) }}"
                                             alt="{{ $special->title }}"
                                             class="w-24 h-24 object-cover rounded-lg">
                                    @endif
                                    <div>
                                        <h4 class="font-semibold">{{ $special->title }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $special->description }}</p>
                                        @if($special->price)
                                            <p class="text-sm text-green-600 dark:text-green-400">{{ number_format($special->price, 2) }} €</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <form action="{{ route('admin.daily-specials.toggle', $special) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1 text-sm rounded-md {{ $special->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200 dark:bg-green-700 dark:text-green-100' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-100' }}">
                                            {{ $special->is_active ? 'Actif' : 'Inactif' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.daily-specials.destroy', $special) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette promotion ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-sm rounded-md bg-red-100 text-red-700 hover:bg-red-200 dark:bg-red-700 dark:text-red-100">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400">Aucune promotion disponible.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
