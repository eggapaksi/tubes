
<link rel="stylesheet" href="{{ asset('style/booking.css') }}">
<div class="booking-page">

    <!-- TOMBOL KEMBALI -->
    <a href="/katalog" class="btn-back">← Kembali</a>
    
    

    <!-- KIRI -->
    <div class="booking-left">
    <div class="image-overlay"></div>

        <img src="/assets/img/fun1.jpg" alt="Fun Game">
        <div class="overlay-text">
            <h1><?= $judul ; ?></p></h1>
        </div>
    </div>

    <!-- KANAN -->
    <div class="booking-right">
        <form class="booking-form" action="{{ route('booking.store') }}" method="POST">
        <form id="bookingForm">
        @csrf
            <h2>Buat Pesanan</h2>
            <input type="hidden" name="nama_katalog" value="{{$judul}}">

            <label>Tanggal</label>
            <input type="date" name="tanggal_booking" >
            <div id="cuaca" style="margin-top:10px; font-weight:bold;"></div>

            <label>Jumlah Pesanan</label>
            <input type="number" name="jumlah" id="jumlah" min="1" value="1">

            <label>Catatan</label>
            <input type="Text" name="catatan" min="1">
            

            {{-- <label>Metode Pembayaran</label>
            <select name="metode_pembayaran">
                <option value="">-- Pilih Metode --</option>
                <option value="Transfer">Transfer Bank</option>
                <option value="QRIS">QRIS</option>
            </select> --}}

            <input type="hidden" name="harga" id="harga" value="{{ (int)$harga }}">
             <div class="biaya">
                <span>Harga/pax</span>
                <span>Rp {{ number_format($harga, 0, ',', '.') }}</p></span>
            </div>

            <div class="Total">
                <span>Total Biaya</span>
                <span id="total">Rp {{ number_format($harga, 0, ',', '.') }}</span>
                
            </div>

            <button type="submit">Reservasi</button>
        </form>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const jumlahInput = document.getElementById('jumlah');
    const hargaInput  = document.getElementById('harga');
    const totalSpan   = document.getElementById('total');

    function hitungTotal() {
        const jumlah = parseInt(jumlahInput.value) || 0;
        const harga  = parseInt(hargaInput.value) || 0;
        const total  = jumlah * harga;

        totalSpan.innerText = 'Rp ' + total.toLocaleString('id-ID');
    }

    jumlahInput.addEventListener('input', hitungTotal);
    hitungTotal(); // hitung saat pertama load
});
const tanggalInput = document.querySelector('[name="tanggal_booking"]');
const cuacaDiv = document.getElementById('cuaca');

tanggalInput.addEventListener('change', function () {
    const tanggal = this.value;

    fetch(`/api/cuaca?tanggal=${tanggal}`)
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            cuacaDiv.innerText = "Perkiraan cuaca: " + data.cuaca;
        } else {
            cuacaDiv.innerText = data.message;
        }
    })
    .catch(() => {
        cuacaDiv.innerText = "";
    });
});
</script>




