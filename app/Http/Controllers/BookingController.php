<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{
    public function index()
    {
        return redirect()->route('katalog.index');
    }

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

        $booking = Booking::create([
            'user_id' => auth()->id(),  
            'nama_pemesan' => auth()->user()->name,  
            'nama_katalog' => $request->nama_katalog,
            'tanggal_booking'=>$request->tanggal_booking,
            'jumlah' => $request->jumlah,
            'total_biaya' => $total,
            'catatan' => $request->catatan
            
            
        ]);
        return redirect()->route('booking.pembayaran', ['id' => $booking->id_booking])
        ->with('success', 'Booking berhasil disimpan');
    
    }
        public function pembayaran($id)
    {   
        $booking = Booking::findOrFail($id);
        $status = $booking->status_pembayaran;
        $snap_token = "";

        if ($status == "Belum Lunas") 
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds');


            $transaction_details = array(
                'order_id' => $booking->id_booking,
                'gross_amount' => $booking->total_biaya 
            );
            $item_details = [
                [
                    'id' => $booking->id_booking,
                    'price' => $booking->total_biaya / $booking->jumlah,
                    'quantity' => $booking->jumlah,
                    'name' => $booking->nama_katalog,

                    
                ]
            ];

            $transaction = array(
                'transaction_details' => $transaction_details,
                'item_details' => $item_details,
            );

            $snap_token = '';
            try {
                $snap_token = \Midtrans\Snap::getSnapToken($transaction);
               
            }

            catch (\Exception $e) {
                echo $e->getMessage();

            }

            echo "snapToken = ".$snap_token;


            return view('pembayaran.index', compact('booking', 'snap_token'));
        }

        public function success()
        {
            return redirect()->route('beranda.index')->with('success', 'Pembayaran berhasil!');
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

        

        public function getCuaca(Request $request)

        {
            $tanggal = $request->query('tanggal');

            if (!$tanggal) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tanggal tidak dikirim'
                ]);
            }

            $response = Http::get('https://api.open-meteo.com/v1/forecast', [
                'latitude' => -6.9,
                'longitude' => 107.6,
                'daily' => 'weathercode',
                'timezone' => 'Asia/Jakarta'
            ]);

            $data = $response->json();

            $dates = $data['daily']['time'];
            $codes = $data['daily']['weathercode'];

            $index = array_search($tanggal, $dates);

            if ($index !== false) {
                $code = $codes[$index];

                return response()->json([
                    'status' => 'success',
                    'cuaca' => $this->translateWeather($code)
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => ''
            ]);
        }

        private function translateWeather($code)
        {
            if ($code == 0) return "Cerah ☀️";
            if ($code <= 3) return "Berawan ☁️";
            if ($code <= 48) return "Berkabut 🌫️";
            if ($code <= 67) return "Hujan 🌧️";
            if ($code <= 82) return "Hujan deras 🌧️";
            if ($code <= 95) return "Badai ⛈️";
            if ($code <= 99) return "Hujan Badai ⛈️";

            return "Tidak diketahui";
        }

        public function storeApi(Request $request)
        {
            $request->validate([
                'nama_katalog' => 'required',
                'tanggal_booking' => 'required|date',
                'jumlah' => 'required|integer|min:1',
            ]);

            // hitung total
            $total = $request->jumlah * $request->harga;

            // simpan ke database
            $booking = Booking::create([
                'user_id' => auth()->id() ?? 1, 
                'nama_pemesan' => 'API User',
                'nama_katalog' => $request->nama_katalog,
                'tanggal_booking' => $request->tanggal_booking,
                'jumlah' => $request->jumlah,
                'total_biaya' => $total,
                'metode_pembayaran' => $request->metode_pembayaran,
                'catatan' => $request->catatan
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Booking berhasil dibuat',
                'data' => $booking
            ]);
        }


    
}

    

