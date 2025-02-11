<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Http\Resources\ReservationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     */
    public function index()
    {
        $reservations = Reservation::all();
        return response()->json([
            'status' => true,
            'reservations' => ReservationResource::collection($reservations)
        ], 200);
    }

    /**
     * Store a newly created reservation in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|integer',
            'table_no' => 'required|string|max:10',
            'customer_contact_no' => 'required|string|max:15',
            'customer_name' => 'required|string|max:255',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        $reservation = Reservation::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Reservation Created Successfully',
            'reservation' => new ReservationResource($reservation)
        ], 201);
    }

    /**
     * Display the specified reservation.
     */
    public function show($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json([
                'status' => false,
                'message' => 'Reservation Not Found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'reservation' => new ReservationResource($reservation)
        ], 200);
    }

    /**
     * Update the specified reservation in storage.
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json([
                'status' => false,
                'message' => 'Reservation Not Found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'branch_id' => 'nullable|integer',
            'table_no' => 'nullable|string|max:10',
            'customer_contact_no' => 'nullable|string|max:15',
            'customer_name' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        $reservation->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Reservation Updated Successfully',
            'reservation' => new ReservationResource($reservation)
        ], 200);
    }

    /**
     * Remove the specified reservation from storage.
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json([
                'status' => false,
                'message' => 'Reservation Not Found'
            ], 404);
        }

        $reservation->delete();

        return response()->json([
            'status' => true,
            'message' => 'Reservation Deleted Successfully'
        ], 200);
    }
}
