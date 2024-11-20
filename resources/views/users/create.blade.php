<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ajouter un utilisateur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="name" value="Nom" class="text-gray-300" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" value="Email" class="text-gray-300" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" value="Mot de passe" class="text-gray-300" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="role" value="Rôle" class="text-gray-300" />
                            <select id="role" name="role" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md shadow-sm" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">
                                        @if($role->name === 'order_manager')
                                            Gestionnaire de commandes
                                        @else
                                            {{ $role->name }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-green-600 hover:bg-green-700">
                                Ajouter l'utilisateur
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
