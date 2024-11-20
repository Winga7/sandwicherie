<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $cartItems = session()->get('cart', []);

        $itemId = uniqid();
        $cartItems[$itemId] = [
            'name' => $request->item_name,
            'category' => $request->category,
            'price' => $request->price ?? ($request->size === 'grand' ? $request->prix_grand : $request->prix_normal),
            'quantity' => $request->quantity,
            'notes' => $request->notes,
            'size' => $request->size ?? null
        ];

        session()->put('cart', $cartItems);

        return redirect()->back()->with('success', '✨ Produit ajouté au panier !');
    }
}
