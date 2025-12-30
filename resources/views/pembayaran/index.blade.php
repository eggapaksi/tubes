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
            <span class="icon">✔</span>
            <div>
                <h2>Reservasi Berhasil</h2>
                <p>Reservasi Anda telah dikonfirmasi, silahkan lakukan pembayaran</p>
            </div>
        </div>

        <!-- Booking Details -->
        <section class="section">
            <h3>Detail Reservasi</h3>
            <div class="grid">
                <div>
                    <small>Nama Pesanan</small>
                    <p>{{$nama_katalog}}</p>
                </div>
                <div>
                    <small>Jumlah Pesanan</small>
                    <p>{{$jumlah}}</p>
                </div>

                <div>
                    <small>Tanggal</small>
                    <p>{{$tanggal_booking}}</P>
                </div>
                <div>
                    <small>Total Pembayaran</small>
                    <p>Rp {{ number_format($total_biaya, 0, ',', '.') }}</p>
                </div>
                <form class="booking-form" action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="nama_katalog" value="{{$nama_katalog}}">
                <input type="hidden" name="tanggal_booking" value="{{$tanggal_booking}}">
                <input type="hidden" name="jumlah" value="{{$jumlah}}">
                <input type="hidden" name="catatan" value="{{$catatan}}">
                <input type="hidden" name="metode_pembayaran" value="{{$metode_pembayaran}}">
                <input type="hidden" name="total_biaya" value="{{$total_biaya}}">
                <button type="submit">Selesai Pembayaran</button>
                </form>

            </div>
        </section>

        <!-- Payment Section -->
        <section class="section payment-section" id="paymentSection"></section>

    </div>
</main>

<script>
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
</script>

</body>
</html>