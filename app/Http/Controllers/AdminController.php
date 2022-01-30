<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function customers(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['data' => User::with('rewardPoints')->where('user_type','=','customer')->get()],200);
    }

    public function orders()
    {
        $orders = Order::with('user','product')
            ->orderBy('id', 'desc')
            ->get();
        return response()->json(['data' => $orders],200);
    }
}
