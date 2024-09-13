<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancelBookingRequest;
use App\Http\Resources\BookingResource;
use App\Mail\BookingCancellationMail;
use App\Models\Activity;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Events\BookingCreated;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all();
        return BookingResource::collection($bookings);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $activity = Activity::find($request['activity_id']);
        if ($activity->available_slots < $request['slots_booked']) {
            return response()->json(['error' => 'Not enough slots available'], 400);
        }

        $activity->available_slots -= $request['slots_booked'];
        $activity->save();

        $booking = Booking::create($request);
        event(new BookingCreated($booking));

        return new BookingResource($booking);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return new BookingResource($booking);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {

        $booking->update($request->all());
        return new BookingResource($booking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->noContent();
    }

    public function cancel(CancelBookingRequest $request,Booking $booking)
    {
        // Find the booking
//        $booking = Booking::findOrFail($id);

        // Check if the booking is already cancelled
        if ($booking->status === 'cancelled') {
            return response()->json(['message' => 'Booking is already cancelled.'], 400);
        }

        // Cancel the booking
        $booking->cancel();

        // Optionally, you can dispatch an event or send a notification email here
        Mail::to($booking->user_email)->send(new BookingCancellationMail($booking));

        // Return a response
        return response()->json(['message' => 'Booking cancelled successfully!']);
    }
}
