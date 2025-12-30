<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('katalog.index');
    }

    /* Nerusin Data ke Page Booking */
    public function confirm(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'harga' => 'required|numeric|min:0',
        ]);
    
        return view('booking.index', [
            'judul'   => $request->judul,
            'harga'   => (int)$request->harga,
            'peserta' => $request->peserta,
            'tingkat' => $request->tingkat,
            'jarak'   => $request->jarak,
            'durasi'  => $request->durasi,
        ]);
    }

    /* Nyimpen Pesanan Ke Database */
    public function store(Request $request)
    {
        
        $request->validate([
            'nama_katalog' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_booking' => 'required|date',
        ]);

        
        $total = $request->jumlah * $request->harga;

        Booking::create([
            'user_id' => auth()->id(),  
            'nama_pemesan' => auth()->user()->name,  
            'nama_katalog' => $request->nama_katalog,
            'tanggal_booking'=>$request->tanggal_booking,
            'jumlah' => $request->jumlah,
            'total_biaya' => $request->total_biaya,
            'metode_pembayaran'=>$request->metode_pembayaran,
            'catatan' => $request->catatan
            
            
        ]);

        return redirect()->route('katalog.index')
        ->with('success', 'Booking berhasil disimpan');
    
    }
    //     public function show($id)
    // {
    //     // sementara aja
    //     return redirect()->route('booking.index');
    // }
        public function pembayaran(Request $request)
    {   
        $request->validate([
            'nama_katalog' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_booking' => 'required|date',
        ]);


        $total = $request->jumlah * $request->harga;

        return view('pembayaran.index',[
            'id_client' => 1,  
            'nama_katalog' => $request->nama_katalog,
            'tanggal_booking'=>$request->tanggal_booking,
            'jumlah' => $request->jumlah,
            'total_biaya' => $total,
            'catatan' => $request->catatan,
            'metode_pembayaran'=>$request->metode_pembayaran
            ]);
    }
        public function list()
        {
            $user = $user = auth()->user();

            if ($user->role === 'admin') {
                $bookings = Booking::latest()->get();
            } else {
                $bookings = Booking::where('user_id', $user->id)->latest()->get();
            }

            return view('booking.list', compact('bookings', 'user'));
        }

        /* =======================
        EDIT
        ======================= */
        public function edit($id)
        {
            $booking = Booking::findOrFail($id);
            return view('booking.edit', compact('booking'));
        }

        /* =======================
        UPDATE
        ======================= */
        public function update(Request $request, $id)
        {
            $booking = Booking::findOrFail($id);

            $booking->update([
                'jumlah' => $request->jumlah,
                'tanggal_booking' => $request->tanggal_booking,
                'catatan' => $request->catatan,
                'status_pembayaran' => $request->status_pembayaran,
            ]);

            return redirect()->route('booking.list')
                ->with('success', 'Pesanan berhasil diperbarui');
        }

        /* =======================
        BATALKAN PESANAN
        ======================= */
        public function destroy($id)
        {
            $booking = Booking::findOrFail($id);
            $booking->delete();

            return redirect()->route('booking.list')
                ->with('success', 'Pesanan berhasil dibatalkan');
        }





    
    
}

    

