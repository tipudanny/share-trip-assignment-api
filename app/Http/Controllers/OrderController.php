<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('users')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();
        return response()->json(['data' => $orders],200);
    }
    public function store()
    {

    }
    public function show()
    {

    }
}
