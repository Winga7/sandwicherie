<?php

namespace App\Http\Controllers;

use App\Models\DailySpecial;
use Illuminate\Http\Request;

class DailySpecialController extends Controller
{
    public function index()
    {
        $dailySpecials = DailySpecial::where('is_active', true)->get();
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
        ]);

        $validated['is_active'] = true;

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
