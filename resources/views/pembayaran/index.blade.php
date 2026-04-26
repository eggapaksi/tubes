<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="{{ asset('style/pembayaran.css') }}">
    <a href="/booking/confirm" class="btn-back">← Kembali</a>
</head>
<body>

<header class=>
</header>

<main class="page-wrapper">
    <div class="booking-card">

        <!-- Header -->
        <div class="status-box">
            <span class="icon"></span>
            <div>
                <h2>Invoice Pembayaran</h2>
                <p>Silahkan lakukan pembayaran</p>
            </div>
        </div>

        <!-- Booking Details -->
        <section class="section">
            <h3>Detail Reservasi</h3>
            <div class="grid">
                <div>
                    <small>Nama Pesanan</small>
                    <p>{{$booking->nama_katalog}}</p>
                </div>
                <div>
                    <small>Jumlah Pesanan</small>
                    <p>{{$booking->jumlah}}</p>
                </div>

                <div>
                    <small>Tanggal</small>
                    <p>{{$booking->tanggal_booking}}</P>
                </div>
                <div>
                    <small>Total Pembayaran</small>
                    <p>Rp {{ number_format($booking->total_biaya, 0, ',', '.') }}</p>
                </div>
              

            </div>
        </section>

        <!-- Payment Section -->
            <form class="booking-form" action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    {{-- <input type="hidden" name="nama_katalog" value="{{$booking->nama_katalog}}">
                    <input type="hidden" name="tanggal_booking" value="{{$booking->tanggal_booking}}">
                    <input type="hidden" name="jumlah" value="{{$booking->jumlah}}">
                    <input type="hidden" name="catatan" value="{{$booking->catatan}}">
                    {{-- <input type="hidden" name="metode_pembayaran" value="{{$metode_pembayaran}}"> --}}
                    {{-- <input type="hidden" name="harga" value="{{$booking->harga}}">
                    <input type="hidden" name="total_biaya" value="{{$booking->total_biaya}}"> --}}
                    <button class="btn-bayar" type="button" id="pay-button">Bayar</button>
                    </form>

    </div>
</main>

{{-- <script>
    // simulasi pilihan pembayaran
    const paymentMethod = "{{$metode_pembayaran}}"; // qris | transfer

    const paymentSection = document.getElementById("paymentSection");

    if (paymentMethod === "QRIS") {
        paymentSection.innerHTML = `
            <h3>Pembayaran QRIS</h3>
            <div class="payment-box">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=QRIS-54237982">
                <div class="payment-info">
                    <p><strong>Scan untuk membayar</strong></p>
                    <h2>Rp {{ number_format($total_biaya, 0, ',', '.') }}</h2>
                    <p class="muted">Berlaku 15 menit</p>
                </div>
            </div>
        `;
    } else if (paymentMethod === "Transfer") {
        paymentSection.innerHTML = `
            <h3>Transfer Bank</h3>
            <div class="payment-box">
                <div class="payment-info">
                    <p><strong>Bank BCA</strong></p>
                    <h2>1234567890</h2>
                    <p class="muted">a.n PT Zona Elo</p>
                </div>
            </div>
        `;
    }
</script> --}}
  {{-- <form class="booking-form" action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="nama_katalog" value="{{$nama_katalog}}">
                <input type="hidden" name="tanggal_booking" value="{{$tanggal_booking}}">
                <input type="hidden" name="jumlah" value="{{$jumlah}}">
                <input type="hidden" name="catatan" value="{{$catatan}}">
                {{-- <input type="hidden" name="metode_pembayaran" value="{{$metode_pembayaran}}"> --}}
                {{--<input type="hidden" name="total_biaya" value="{{$total_biaya}}">
                <button type="submit">Selesai Pembayaran</button>
                </form> --}}
    

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-N-JV4totI2c3jrWZ"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $snap_token}}', {
          // Optional
          onSuccess: function(result){
            window.location.href = "/booking/success/" + result.order_id;
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
</body>
</html>