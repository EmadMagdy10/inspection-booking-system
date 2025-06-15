<?php

namespace Modules\Bookings\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Team\Models\Team;
use App\Http\Controllers\Controller;
use Modules\Bookings\Models\Booking;
use Modules\Bookings\Services\BookingService;
use Modules\Bookings\Http\Requests\StoreBookingRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingsController extends Controller
{
    protected $service;
    use AuthorizesRequests;

    public function __construct(BookingService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())->with('team')->get();

        return response()->json($bookings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bookings::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $start = Carbon::parse($request->start_time);
        $end = Carbon::parse($request->end_time);
        $team = Team::withoutGlobalScopes()->findOrFail($request->team_id);

        $this->authorize('create', [Booking::class, $team]);

        if ($this->service->hasConflict($request->team_id, $start, $end)) {
            return response()->json(['message' => 'Slot already booked'], 409);
        }

        $booking = $this->service->createBooking(auth()->id(), $request->team_id, $start, $end);

        return response()->json(['message' => 'Booking successful', 'booking' => $booking]);
    }
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('bookings::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('bookings::edit');
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
        $booking = Booking::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $booking->delete();

        return response()->json(['message' => 'Booking canceled']);
    }
}
