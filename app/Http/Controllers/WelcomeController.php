<?php

namespace App\Http\Controllers;

use App\Models\DailySpecial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{
    public function index()
    {
        $dailySpecials = DailySpecial::where('is_active', true)->get();

        // Débogage pour voir les chemins d'images
        foreach ($dailySpecials as $special) {
            Log::info('✨ Image path kawaii: ' . $special->image_path);
            Log::info('🌟 Full URL desu: ' . asset('storage/' . $special->image_path));
            Log::info('🔍 File exists check: ' . (file_exists(storage_path('app/public/' . $special->image_path)) ? 'Hai!' : 'Iie...'));
        }

        return view('welcome', compact('dailySpecials'));
    }
}
