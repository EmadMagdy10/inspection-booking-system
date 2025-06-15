<?php

namespace Modules\Team\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Team\Models\Team;
use App\Http\Controllers\Controller;
use Modules\Team\Http\Requests\StoreTeamRequest;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();
        return response()->json($teams);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $team = Team::create($request->validated());
        return response()->json(['message' => 'Team created', 'team' => $team], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $team = Team::findOrFail($id);
    $team->delete();

    return response()->json([
        'message' => 'Team deleted successfully'
    ]);
}}
