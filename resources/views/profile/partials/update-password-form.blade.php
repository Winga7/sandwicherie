<section class="space-y-6 bg-gray-800 p-4 rounded-lg shadow"></section>
    <header>
        <h2 class="text-lg font-medium text-gray-100">
            Modifier le mot de passe
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            Assurez-vous d'utiliser un mot de passe long et sécurisé pour protéger votre compte.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" value="Mot de passe actuel" class="text-gray-300" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Nouveau mot de passe" class="text-gray-300" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" class="text-gray-300" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-green-600 hover:bg-green-700">
                Sauvegarder
            </x-primary-button>
            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-400">Sauvegardé.</p>
            @endif
        </div>
    </form>
</section>
