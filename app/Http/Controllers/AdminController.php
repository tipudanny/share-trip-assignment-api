<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Slab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function customers()
    {
        $customers = User::with('rewardPoints')
            ->where('user_type','=','customer')
            ->orderBy('id','desc')
            ->get();
        $slabs = Slab::all();

        foreach ($customers as $customer){
            foreach ($slabs as $slab){
                if (($customer->rewardPoints !=null) && ($customer->rewardPoints->points >= $slab->points) ){
                    $customer->slab = $slab->title;
                }
            }
        }

        return response()->json(['data' => $customers],200);
    }

    public function orders()
    {
        $orders = Order::with('user','product')
            ->orderBy('id', 'desc')
            ->get();
        return response()->json(['data' => $orders],200);
    }
}
