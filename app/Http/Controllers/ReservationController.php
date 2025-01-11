<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Branch;

class ReservationController extends Controller
{
    /**
     * Show the reservation form.
     */
    public function create()
    {
        $branches = Branch::all(); 
        return view('pages.book', ['branches' => $branches]);
    }

    /**
     * Store the reservation in the database.
     */
    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'branch_id' => 'required|integer',
            'table_no' => 'required|integer',
            'customer_contact_no' => 'required|string|max:15',
            'customer_name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // Create a new reservation
        Reservation::create([
            'branch_id' => $request->branch_id,
            'table_no' => $request->table_no,
            'customer_contact_no' => $request->customer_contact_no,
            'customer_name' => $request->customer_name,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        // Redirect to a success page (or redirect back to the form)
        return redirect()->route('reservation.create')->with('success', 'Reservation created successfully!');

        
    }
}
