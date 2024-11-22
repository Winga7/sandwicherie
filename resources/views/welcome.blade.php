<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Panidel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Navigation -->
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Se connecter</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">S'inscrire</a>
                        @endif
                    @endauth
                </div>
            @endif

            <!-- Hero Section -->
            <div class="pt-24 px-6">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-4xl font-bold text-center text-gray-900 dark:text-white mb-8">
                        Bienvenue chez Panidel 🥪
                    </h1>

                    <!-- Promotions du jour -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                                🌟 Promotions du jour
                            </h2>
                            @if(isset($dailySpecials))
                                @forelse($dailySpecials as $special)
                                    <div class="mb-4 p-4 border border-gray-200 dark:border-gray-700 rounded">
                                        @if($special->image_path)
                                            <div class="relative group cursor-pointer" onclick="openModal('{{ $special->title }}', '{{ $special->description }}', '{{ asset('storage/' . $special->image_path) }}', '{{ $special->price ? number_format($special->price, 2) . ' €' : '' }}')">
                                                <img src="{{ asset('storage/' . $special->image_path) }}"
                                                     alt="{{ $special->title }}"
                                                     class="w-full h-48 object-cover rounded-lg mb-4 transition-transform duration-300 transform hover:scale-105"
                                                     onerror="handleImageError(this)">
                                            </div>
                                        @endif
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $special->title }}
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-400 mt-2">
                                            {{ $special->description }}
                                        </p>
                                        @if($special->price)
                                            <p class="text-green-600 dark:text-green-400 font-semibold mt-2">
                                                {{ number_format($special->price, 2) }} €
                                            </p>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-gray-600 dark:text-gray-400">
                                        Aucune promotion en cours
                                    </p>
                                @endforelse
                            @else
                                <p class="text-gray-600 dark:text-gray-400">
                                    Chargement des promotions...
                                </p>
                            @endif
                        </div>

                        <!-- Horaires et Contact -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                                ⏰ Nos horaires
                            </h2>
                            <div class="space-y-2 text-gray-600 dark:text-gray-400">
                                <p>Lundi - Vendredi : 9h30 - 15h00</p>
                                <p>Samedi : 10h00 - 15h00</p>
                                <p>Dimanche : Fermé</p>
                            </div>

                            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4 mt-8">
                                📍 Où nous trouver
                            </h2>
                            <div class="space-y-2 text-gray-600 dark:text-gray-400">
                                <p>Adresse : Pl. des Carmes 3, 1300 Wavre</p>
                                <p>Téléphone : 010 22 75 35</p>
                                <p>Email : contact@panidel.com</p>
                                <div class="mt-4 aspect-video w-full">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2526.2426197893155!2d4.6078483!3d50.7154379!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c17d75b55b145f%3A0x63efd4c18bf251f0!2sPanidel%20Snack!5e0!3m2!1sfr!2sbe!4v1732109298829!5m2!1sfr!2sbe"
                                        class="w-full h-full rounded-lg"
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal kawaii ✨ -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg max-w-2xl w-full mx-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modalTitle" class="text-xl font-bold text-gray-900 dark:text-white"></h3>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                </div>
                <img id="modalImage" alt="" onerror="handleImageError(this)">
                <p id="modalDescription" class="text-gray-600 dark:text-gray-400 mb-2"></p>
                <p id="modalPrice" class="text-green-600 dark:text-green-400 font-bold"></p>
            </div>
        </div>

        <script>
        function handleImageError(img) {
            console.error('(っ °Д °;)っ Oops! Image non chargée:', img.src);
            img.style.display = 'none';
            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-red-500 text-center p-4 bg-red-100 dark:bg-red-900 rounded-lg';
            errorDiv.textContent = '(っ °Д °;)っ Image non disponible';
            img.parentNode.appendChild(errorDiv);
        }

        function handleImageLoad(img) {
            console.log('(◕‿◕✿) Image chargée avec succès!');
            img.style.display = 'block';
            document.getElementById('imageLoadingError').classList.add('hidden');
        }

        function openModal(title, description, imageUrl, price) {
            console.log('✨ Ouverture du modal avec l\'image:', imageUrl);
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');

            modalImage.src = imageUrl;
            modalImage.alt = title;
            modalImage.className = "w-full h-auto object-contain rounded-lg mb-4 transition-transform duration-300";

            document.getElementById('modalTitle').textContent = '✨ ' + title + ' ✨';
            document.getElementById('modalDescription').textContent = description;
            document.getElementById('modalPrice').textContent = '💝 ' + price;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            const content = document.getElementById('modalContent');

            content.classList.add('scale-95', 'opacity-0');
            content.classList.remove('scale-100', 'opacity-100');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }
        </script>
    </body>
</html>
