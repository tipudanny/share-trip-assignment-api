<?php

namespace App\Http\Controllers;

use App\Http\Requests\RewardRateStoreRequest;
use App\Http\Resources\RewardRateResource;
use App\Models\RewardPointRate;
use Illuminate\Http\Request;

class RewardPointRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rate = RewardPointRate::orderBy('id', 'desc')->get();
        return RewardRateResource::collection($rate);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RewardRateStoreRequest $request)
    {
        $rewardRate = RewardPointRate::all();
        if (sizeof($rewardRate) > 0 ){
            return response()->json(['message'=> ' Already have a rate, Update this one.']);
        }

        $rewardRate = RewardPointRate::create($request->all());

        return response()->json(['data'=> $rewardRate]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rewardRate = RewardPointRate::find($id);
        if ($rewardRate) {
            return response()->json(['data' => $rewardRate], 200);
        }
        return response()->json(['error' => 'No Reward Rate found.'], 422);
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
        $slab = RewardPointRate::findOrFail($id);
        try {

            //$slab->title = $request['title'];
            $slab->rate = $request['rate'];
            $slab->save();

            return response()->json(['data' => $slab, 'message' => 'Reward Rate Update Successfully'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update Reward Rate!'], 422);
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
