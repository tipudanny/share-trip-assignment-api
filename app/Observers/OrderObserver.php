<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Reward;
use Illuminate\Database\Eloquent\Model;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function created(Order $order)
    {
        $userReward = Reward::where('user_id', $order['user_id'])->first();

        if ($userReward != null) {
            $userReward->points = $userReward['points'] + $order['point_rewarded'];
            $userReward->save();
        }
        else {
            $reward = new Reward;
            $reward->user_id = $order['user_id'];
            $reward->points =$order['point_rewarded'];
            $reward->save();
        }
    }


}
