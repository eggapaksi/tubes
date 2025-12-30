<?php
$rafting = [
    [
        "judul" => "Rafting Sungai Elo",
        "peserta" => "4 Orang / Boat",
        "tingkat" => "Wisata / Pemula",
        "jarak" => "10 - 12 km",
        "durasi" => "2 – 3 Jam",
        "harga" => "650.000 / Boat",
        "gambar" => "assets/img/rafting1.jpg"
    ],
    [
        "judul" => "Rafting Progo Atas",
        "peserta" => "4 Orang / Boat",
        "tingkat" => "Wisata / Menengah",
        "jarak" => "9 km",
        "durasi" => "2 Jam",
        "harga" => "850.000 / Boat",
        "gambar" => "assets/img/rafting2.jpg"
    ]
];

$funGame = [
    [
        "judul" => "FUN 1",
        "durasi" => "1 Jam",
        "harga" => "50.000 / pax",
        "gambar" => "assets/img/fun1.jpg"
    ],
    [
        "judul" => "FUN 2",
        "durasi" => "2 Jam",
        "harga" => "80.000 / pax",
        "gambar" => "assets/img/fun2.jpg"
    ]
];
?>

<header class="layout.header">
        @include('layout.header')
    </header>
<body>
<link rel="stylesheet" href="style/katalog.css">
<section class="section rafting-layout">
    <!-- KIRI : KATALOG RAFTING -->
    <div class="rafting-left">
        <?php foreach ($rafting as $item): ?>
        <div class="card">
            <img src="<?= $item['gambar']; ?>" alt="">
            <div class="info">
                <h3><?= $item['judul']; ?></h3>
                <p>Peserta : <?= $item['peserta']; ?></p>
                <p>Tingkat : <?= $item['tingkat']; ?></p>
                <p>Jarak : <?= $item['jarak']; ?></p>
                <p>Durasi : <?= $item['durasi']; ?></p>
                <span class="price"><?= $item['harga']; ?></span>
                <form action="{{ route('booking.confirm') }}" method="POST">
                @csrf
                    <input type="hidden" name="judul" value="<?= $item['judul']; ?>">
                    <input type="hidden" name="harga" value="<?= preg_replace('/[^0-9]/', '', $item['harga']); ?>">
                    <input type="hidden" name="peserta" value="<?= $item['peserta']; ?>">
                    <input type="hidden" name="tingkat" value="<?= $item['tingkat']; ?>">
                    <input type="hidden" name="jarak" value="<?= $item['jarak']; ?>">
                    <input type="hidden" name="durasi" value="<?= $item['durasi']; ?>">

                    <button type="submit" class="btn">Reservasi</button>
                </form>

            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- KANAN : FASILITAS -->
    <div class="rafting-right">
        <h1>Rafting Zona Elo</h1>

        
        <ul class="fasilitas">
            <h3>Fasilitas</h3>
            <li>Peralatan Rafting</li>
            <li>Pemandu Profesional</li>
            <li>Transportasi Lokal</li>
            <li>P3K Standar</li>
            <li>Insurance</li>
            <li>Makan 1x</li>
            <li>Snack</li>
            <li>Kelapa Muda</li>
        </ul>

        <h3>Jadwal Kegiatan</h3>
        <div class="jadwal">
            <div class="jadwal-item">
                <strong>Trip Pagi</strong>
                <p>07.00 – 08.30</p>
            </div>
            <div class="jadwal-item">
                <strong>Trip Siang</strong>
                <p>12.30 – 14.00</p>
            </div>
            <div class="jadwal-item">
                <strong>By Request</strong>
                <p>Menyesuaikan</px`>
            </div>
        </div>
    </div>

</section>

<!-- FUN GAME -->
<section class="section fungame-layout">

    <!-- KIRI -->
    <div class="fungame-left">
        <h2 class="fungame-title">Fun Game</h2>

        <p class="fungame-desc">
            Mencairkan suasana, menghilangkan sekat-sekat pembatas antar peserta,
            dan mengakrabkan peserta, menggunakan metode Experiential Learning.
        </p>

        <!-- BOX FASILITAS -->
        <div class="fasilitas-box">
            <h3>Fasilitas</h3>
            <ul>
                <li>Program Kegiatan</li>
                <li>Properti</li>
                <li>Fasilitator Bersertifikat</li>
                <li>Co Fasilitator</li>
                <li>P3K Standard</li>
                <li>Pengeras Suara</li>
                <li>Lokasi Kegiatan</li>
            </ul>
        </div>
    </div>

    <!-- KANAN -->
    <div class="fungame-right">
        <?php foreach ($funGame as $fun): ?>
        <div class="fun-card">
            <img src="<?= $fun['gambar']; ?>" alt="">
            <div class="fun-info">
                <h3><?= $fun['judul']; ?></h3>
                <p>Kegiatan Fun Game dengan durasi <?= $fun['durasi']; ?></p>

                <div class="fun-bottom">
                    <span class="price"><?= $fun['harga']; ?></span>
                        <form action="{{ route('booking.confirm') }}" method="POST">
                        @csrf
                            <input type="hidden" name="judul" value="<?= $fun['judul']; ?>">
                            <input type="hidden" name="harga" value="<?= preg_replace('/[^0-9]/', '', $fun['harga']); ?>">
                            <input type="hidden" name="durasi" value="<?= $fun['durasi']; ?>">

                            <button type="submit" class="btn">Reservasi</button>
                        </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</section>
@include('katalog.dokumentasi')
</body>




{{-- <!-- OVERLAY -->
<div class="modal-overlay" id="modalOverlay"></div>

<!-- MODAL -->
<div class="modal" id="bookingModal">
    <div class="modal-header">
        <h3>Buat Pesanan</h3>

        <div class="btn-x">
            <span class="close" onclick="closeModal()">×</span>
        </div>
        
    </div>

   

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
  
            <div class="namaPesanan">
                <b>
                <span id= 'namaKatalog' name="nama_katalog"></span>
                </b>
                <input type="hidden" name="nama_katalog" id="namaPesanan">

            </div>

        <div class="modal-body">
            
            <label>Tanggal</label>
            <input type="date" name="tanggal_booking" ><br>

            <label>Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" min="1" onchange="hitungTotal()"><br>

            <label>Catatan</label>
            <input type="text" name="catatan"><br>

            <div class="biaya">
                <span>Harga/pax</span>
                <span id="hargaPax"></span>

            <input type="hidden" name="harga" id="harga">
            </div>
            <div class="biaya">
                <span>Total Biaya</span>
                <span id="totalBiaya">Rp 0</span>
            </div>

        </div>

        <button type="submit" class="btn-full">Reservasi</button>
    </form>
    </div>
</div>

<script>
let hargaPaket = 0

function openModal(nama, harga) {
    document.getElementById('modalOverlay').style.display = 'block';
    document.getElementById('bookingModal').style.display = 'block';

    document.getElementById('namaKatalog').innerText = nama;
    document.getElementById('namaPesanan').value = nama;
    document.getElementById('harga').value = harga;
    hargaPaket = harga;

    document.getElementById('hargaPax').innerText = formatRupiah(harga);
        

    hitungTotal();
}

function closeModal() {
    document.getElementById('modalOverlay').style.display = 'none';
    document.getElementById('bookingModal').style.display = 'none';
}

function hitungTotal() {
    let jumlah = document.getElementById('jumlah').value;

    let total = hargaPaket * jumlah;
    document.getElementById('totalBiaya').innerText = formatRupiah(total);
}

function formatRupiah(angka) {
    return 'Rp ' + angka.toLocaleString('id-ID');
}
</script> --}}

