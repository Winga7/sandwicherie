<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function history()
    {
        // Pour l'instant, retournons simplement une vue
        return view('orders.history');
    }
}
