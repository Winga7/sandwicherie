<?php

namespace App\Http\Controllers;

use App\Models\DailySpecial;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class DailySpecialController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $dailySpecials = DailySpecial::orderBy('created_at', 'desc')->get();
        return view('admin.daily-specials.index', compact('dailySpecials'));
    }

    public function welcome()
    {
        $dailySpecials = DailySpecial::where('is_active', true)->get();
        return view('welcome', compact('dailySpecials'));
    }

    public function manage()
    {
        $this->authorize('manage menu');
        $dailySpecials = DailySpecial::orderBy('created_at', 'desc')->get();
        return view('admin.daily-specials.index', compact('dailySpecials'));
    }

    public function store(Request $request)
    {
        $this->authorize('manage menu');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $validated['is_active'] = true;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;

            try {
                Log::info('✨ Tentative de déplacement de l\'image vers: ' . storage_path('app/public/promotions'));
                $path = $file->move(storage_path('app/public/promotions'), $filename);
                Log::info('🌟 Chemin après déplacement: ' . $path);
                $validated['image_path'] = 'promotions/' . $filename;
                Log::info('💝 Chemin final enregistré: ' . $validated['image_path']);
            } catch (\Exception $e) {
                Log::error('Erreur upload image: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'Erreur lors du téléchargement de l\'image']);
            }
        }

        DailySpecial::create($validated);

        return redirect()->back()->with('success', 'Promotion ajoutée avec succès !');
    }

    public function toggle(DailySpecial $dailySpecial)
    {
        $this->authorize('manage menu');

        $dailySpecial->update([
            'is_active' => !$dailySpecial->is_active
        ]);

        return redirect()->back()->with(
            'success',
            $dailySpecial->is_active ? 'Promotion activée !' : 'Promotion désactivée !'
        );
    }

    public function destroy(DailySpecial $dailySpecial)
    {
        $this->authorize('manage menu');

        $dailySpecial->delete();

        return redirect()->back()->with('success', 'Promotion supprimée !');
    }
}
