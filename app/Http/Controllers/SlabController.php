<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlabStoreRequest;
use App\Http\Requests\SlabUpdateRequest;
use App\Http\Resources\SlabResource;
use App\Models\Slab;
use Illuminate\Http\Request;

class SlabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slab = Slab::orderBy('id', 'desc')->get();
        return SlabResource::collection($slab);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlabStoreRequest $request)
    {
        try {
            $slab = Slab::create($request->all());
            return response()->json([
                'product' => $slab,
                'message' => 'Slab Created Successfully',
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to add slab!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slab = Slab::find($id);
        if ($slab) {
            return response()->json(['data' => $slab], 200);
        }
        return response()->json(['error' => 'No slab found.'], 422);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlabUpdateRequest $request, $id)
    {
        $slab = Slab::findOrFail($id);
        try {
            $slab->update($request->all());
            return response()->json(['data' => $slab, 'message' => 'Slab Update Successfully'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update slab!'], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slab = Slab::findOrFail($id);
        try {
            $slab->delete();
            return response()->json(['success' => 'Slab Deleted Successfully'], 200);
        }
        catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete slab!'], 422);
        }
    }
}
