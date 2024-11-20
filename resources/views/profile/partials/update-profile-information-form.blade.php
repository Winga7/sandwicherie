<section class="space-y-6 bg-gray-800 p-4 rounded-lg shadow"></section>
    <header>
        <h2 class="text-lg font-medium text-gray-100">
            Informations du Profil
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            Mettez à jour les informations de votre profil et votre adresse email.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nom" class="text-gray-300" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" class="text-gray-300" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-green-600 hover:bg-green-700">
                Sauvegarder
            </x-primary-button>
            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-400">Sauvegardé.</p>
            @endif
        </div>
    </form>
</section>
