<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PanidelProductsSeeder extends Seeder
{
    public function run(): void
    {
        // On s'assure que le JSON est bien un tableau
        $jsonContent = file_get_contents(database_path('data/panidelCarte.json'));
        if (!$jsonContent) {
            throw new \Exception('Le fichier panidelCarte.json est introuvable dans le dossier database/data/');
        }

        $jsonData = json_decode($jsonContent, true);
        if (!is_array($jsonData)) {
            throw new \Exception('Le contenu du fichier JSON n\'est pas valide');
        }

        // On traite chaque catégorie
        foreach ($jsonData as $categoryName => $products) {
            if (!is_array($products)) {
                continue; // On saute les éléments qui ne sont pas des tableaux
            }

            // Création de la catégorie
            $categoryId = DB::table('categories')->insertGetId([
                'name' => $categoryName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($products as $product) {
                $productData = [
                    'category_id' => $categoryId,
                    'name' => $product['nom'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Gestion des différents types de prix 💰
                if (isset($product['prix'])) {
                    $productData['price'] = $this->parsePrice($product['prix']);
                    $productData['has_size_options'] = false;
                } else {
                    $productData['price'] = $this->parsePrice($product['prix_normal']);
                    $productData['large_price'] = $this->parsePrice($product['prix_grand']);
                    $productData['has_size_options'] = true;
                }

                $productId = DB::table('products')->insertGetId($productData);

                // Ajout des ingrédients si présents 🥬
                if (isset($product['ingrédients'])) {
                    foreach ($product['ingrédients'] as $ingredientName) {
                        // Création ou récupération de l'ingrédient
                        $ingredientId = DB::table('ingredients')
                            ->where('name', $ingredientName)
                            ->first()?->id ?? DB::table('ingredients')->insertGetId([
                                'name' => $ingredientName,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);

                        // Création de la relation produit-ingrédient
                        DB::table('product_ingredients')->insert([
                            'product_id' => $productId,
                            'ingredient_id' => $ingredientId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }

    private function parsePrice(string $price): float
    {
        return (float) str_replace([',', '€', ' '], ['.', '', ''], $price);
    }
}
