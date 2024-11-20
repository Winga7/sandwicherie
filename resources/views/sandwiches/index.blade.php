<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Notre carte de sandwiches ✨
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    @foreach($carte as $categorie => $items)
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold mb-4 text-indigo-400">{{ $categorie }} 🌟</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($items as $item)
                                    <div class="bg-gray-700 p-4 rounded-lg transform transition-all duration-300 hover:scale-105">
                                        <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                                            @csrf
                                            <input type="hidden" name="item_name" value="{{ $item['nom'] }}">
                                            <input type="hidden" name="category" value="{{ $categorie }}">

                                            <h4 class="text-lg font-semibold mb-2">{{ $item['nom'] }}</h4>

                                            @if(isset($item['prix']))
                                                <p class="text-green-400 mb-2">{{ $item['prix'] }}</p>
                                                <input type="hidden" name="price" value="{{ $item['prix'] }}">
                                            @else
                                                <div class="flex space-x-4">
                                                    <label class="flex items-center space-x-2">
                                                        <input type="radio" name="size" value="normal" class="text-indigo-600" checked>
                                                        <span>Normal: {{ $item['prix_normal'] }}</span>
                                                    </label>
                                                    <label class="flex items-center space-x-2">
                                                        <input type="radio" name="size" value="grand" class="text-indigo-600">
                                                        <span>Grand: {{ $item['prix_grand'] }}</span>
                                                    </label>
                                                </div>
                                            @endif

                                            @if(isset($item['ingrédients']))
                                                <p class="text-gray-300 text-sm">
                                                    {{ implode(', ', $item['ingrédients']) }}
                                                </p>
                                                <textarea
                                                    name="notes"
                                                    class="mt-2 w-full px-3 py-2 rounded-md bg-gray-600 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                    placeholder="Instructions spéciales (ex: sans tomates) 📝"
                                                    rows="2"
                                                ></textarea>
                                            @endif

                                            <div class="flex items-center space-x-4 mt-4">
                                                <div class="flex items-center space-x-2">
                                                    <label for="quantity" class="text-sm">Quantité:</label>
                                                    <select
                                                        name="quantity"
                                                        class="bg-gray-600 text-white rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                    >
                                                        @for($i = 1; $i <= 10; $i++)
                                                            <option value="{{ $i }}" class="text-gray-900 bg-white">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <button type="submit" class="flex-grow bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition-colors duration-300">
                                                    Commander 🛍️
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
