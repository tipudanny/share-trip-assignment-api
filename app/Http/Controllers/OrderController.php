<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Interfaces\RewardPoint;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('user','product')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();
        return response()->json(['data' => $orders],200);
    }

    public function store(OrderStoreRequest $request)
    {
        try {
            $order = Order::create($request->validated());
            return response()->json([
                'order' => $order,
                'message' => 'New Order Created Successfully',
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to add new Order.!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        if (auth()->user()->user_type === 'admin'){
            $order = Order::with('user','product')
                ->find($id);
        }
        else{
            $order = Order::with('user','product')
                ->where('user_id', Auth::id())
                ->find($id);
        }

        if ($order) {
            return response()->json(['data' => $order], 200);
        }
        return response()->json(['error' => 'No Order found.'], 422);
    }
}
