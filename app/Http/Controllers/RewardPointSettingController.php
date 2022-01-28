<?php

namespace App\Http\Controllers;

use App\Http\Requests\RewardSettingStoreRequest;
use App\Models\RewardInPurchases;
use Illuminate\Http\Request;

class RewardPointSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewardInfo = RewardInPurchases::first();
        return response()->json(['data'=> $rewardInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RewardSettingStoreRequest $request)
    {
        $rewardInfo = RewardInPurchases::all();
        if (sizeof($rewardInfo) > 0 ){
            return response()->json(['message'=> ' Already have a Reward Settings, Update this one.']);
        }

        $rewardInfo = RewardInPurchases::create($request->validated());

        return response()->json(['data'=> $rewardInfo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rewardInfo = RewardInPurchases::find($id);
        if ($rewardInfo) {
            return response()->json(['data' => $rewardInfo], 200);
        }
        return response()->json(['error' => 'No Reward Info found.'], 422);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slab = RewardInPurchases::findOrFail($id);
        try {

            //$slab->title = $request['title'];
            $slab->amount = $request['amount'];
            $slab->points = $request['points'];
            $slab->save();

            return response()->json(['data' => $slab, 'message' => 'Reward settings Info Update Successfully'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update Reward settings!'], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
