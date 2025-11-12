<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    // ========================
    //  API CRUD
    // ========================

    public function index()
    {
        return response()->json(Booking::all());
    }

    public function show($id)
    {
        $booking = Booking::find($id);
        return $booking
            ? response()->json($booking)
            : response()->json(['message' => 'Booking not found'], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'package_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'total_person' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        // 🚀 Waktu real-time (Asia/Jakarta)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $booking = Booking::create([
            'user_id'       => $request->user_id,
            'package_id'    => $request->package_id,
            'schedule_id'   => $request->schedule_id,
            'booking_date'  => Carbon::now('Asia/Jakarta'),
            'total_person'  => $request->total_person,
            'total_price'   => $request->total_price,
            'status'        => $request->status
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return response()->json(['message' => 'Booking created', 'data' => $booking], 201);
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $request->validate([
            'user_id' => 'integer',
            'package_id' => 'integer',
            'schedule_id' => 'integer',
            'total_person' => 'integer|min:1',
            'total_price' => 'numeric',
            'status' => 'in:pending,confirmed,cancelled,completed'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $booking->update([
            'user_id'       => $request->user_id ?? $booking->user_id,
            'package_id'    => $request->package_id ?? $booking->package_id,
            'schedule_id'   => $request->schedule_id ?? $booking->schedule_id,
            'booking_date'  => Carbon::now('Asia/Jakarta'),
            'total_person'  => $request->total_person ?? $booking->total_person,
            'total_price'   => $request->total_price ?? $booking->total_price,
            'status'        => $request->status ?? $booking->status,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return response()->json(['message' => 'Booking updated', 'data' => $booking]);
    }

    public function destroy($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->delete();
        return response()->json(['message' => 'Booking deleted'], 200);
    }

    // ========================
    //  VIEW CRUD (Blade)
    // ========================

    public function view()
    {
        $bookings = Booking::all();
        return view('bookings', compact('bookings'));
    }

    public function create()
    {
        return view('booking_create');
    }

    public function storeFromView(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'package_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'total_person' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Booking::create([
            'user_id'       => $request->user_id,
            'package_id'    => $request->package_id,
            'schedule_id'   => $request->schedule_id,
            'booking_date'  => Carbon::now('Asia/Jakarta'), // waktu real
            'total_person'  => $request->total_person,
            'total_price'   => $request->total_price,
            'status'        => $request->status
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect('/view/bookings')->with('success', 'Booking berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking_edit', compact('booking'));
    }

    public function updateFromView(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $booking->update([
            'user_id'       => $request->user_id ?? $booking->user_id,
            'package_id'    => $request->package_id ?? $booking->package_id,
            'schedule_id'   => $request->schedule_id ?? $booking->schedule_id,
            'booking_date'  => Carbon::now('Asia/Jakarta'), // update realtime
            'total_person'  => $request->total_person ?? $booking->total_person,
            'total_price'   => $request->total_price ?? $booking->total_price,
            'status'        => $request->status ?? $booking->status,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect('/view/bookings')->with('success', 'Booking berhasil diubah!');
    }

    public function destroyFromView($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect('/view/bookings')->with('success', 'Booking berhasil dihapus!');
    }
}
