<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
class MidtransController extends Controller{

    public function handleCallback(Request $request)
    {
        // ambil raw JSON
        $raw = $request->getContent();
        $data = json_decode($raw, true);

        Log::info("MIDTRANS CALLBACK", [
            'raw' => $raw,
            'json' => $data
        ]);

        if (!$data) {
            return response()->json(['message' => 'No data'], 400);
        }

        $orderId      = $data['order_id'] ?? null;
        $statusCode   = $data['status_code'] ?? null;
        $grossAmount  = $data['gross_amount'] ?? null;
        $signatureKey = $data['signature_key'] ?? null;

        if (!$orderId || !$statusCode || !$grossAmount || !$signatureKey) {
            Log::error("DATA TIDAK LENGKAP", $data);
            return response()->json(['message' => 'Data tidak lengkap'], 400);
        }

        $serverKey = config('midtrans.server_key');

        $mySignature = hash('sha512',
            $orderId . $statusCode . $grossAmount . $serverKey
        );

        if ($mySignature !== $signatureKey) {
            Log::error("SIGNATURE TIDAK VALID", [
                'order_id' => $orderId
            ]);
            return response()->json(['message' => 'Signature tidak valid'], 403);
        }

        $booking = Booking::find($orderId);

        if (!$booking) {
            Log::error("BOOKING TIDAK DITEMUKAN", [
                'order_id' => $orderId
            ]);
            return response()->json(['message' => 'Booking tidak ditemukan'], 404);
        }

        $transactionStatus = $data['transaction_status'] ?? null;
        $fraudStatus       = $data['fraud_status'] ?? null;

        switch ($transactionStatus) {
            case 'capture':
                if ($fraudStatus == 'accept') {
                    $booking->status_pembayaran = 'Dibayarkan';
                }
                break;

            case 'settlement':
                $booking->status_pembayaran = 'Dibayarkan';
                break;

            case 'pending':
                $booking->status_pembayaran = 'Belum Dibayarkan';
                break;

            case 'deny':
            case 'cancel':
                $booking->status_pembayaran = 'Gagal';
                break;

            case 'expire':
                $booking->status_pembayaran = 'Kadaluarsa';
                break;
        }

        $booking->save();

        Log::info("BOOKING UPDATED", [
            'order_id' => $orderId,
            'status' => $booking->status_pembayaran
        ]);

        return response()->json(['message' => 'Callback diproses'], 200);
    }
}