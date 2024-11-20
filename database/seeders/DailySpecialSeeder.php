<?php

namespace Database\Seeders;

use App\Models\DailySpecial;
use Illuminate\Database\Seeder;

class DailySpecialSeeder extends Seeder
{
    public function run(): void
    {
        DailySpecial::create([
            'title' => 'Menu du Jour 🌟',
            'description' => 'Un sandwich au choix + une boisson + un dessert',
            'price' => 8.50,
            'is_active' => true
        ]);

        DailySpecial::create([
            'title' => 'Happy Hour ⏰',
            'description' => '-20% sur tous les sandwichs entre 14h et 15h',
            'is_active' => true
        ]);
    }
}
