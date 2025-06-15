<?php

namespace Modules\Availability\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Team\Models\Team;
use App\Http\Controllers\Controller;
use Modules\Availability\Models\Availability;
use Modules\Availability\Http\Requests\SetAvailabilityRequest;

class AvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('availability::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('availability::create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(SetAvailabilityRequest $request, $teamId)
{
    $validated = $request->validated();

    foreach ($validated['availability'] as $slot) {
        $teamAvailability = new Availability();
        $teamAvailability->day_of_week = $slot['day_of_week'];
        $teamAvailability->start_time = $slot['start_time'];
        $teamAvailability->end_time = $slot['end_time'];
        $teamAvailability->team_id = $teamId;
        $teamAvailability->save();
    }

    return response()->json(['message' => 'Availability set successfully']);
}
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $team = Team::with('availabilities')->findOrFail($id);

        return response()->json([
            'team_id' => $team->id,
            'availability' => $team->availabilities,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('availability::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
