<link rel="stylesheet" href="{{ asset('style/list.css') }}">

@section('content')
<div class="container">
    <h2>Edit Booking</h2>

    <form action="{{ route('booking.update', ['id' => $booking->id_booking]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Katalog</label>
            <input type="text"
                   name="nama_katalog"
                   class="form-control"
                   value="{{ $booking->nama_katalog }}"
                   readonly>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number"
                   name="jumlah"
                   class="form-control"
                   value="{{ $booking->jumlah }}">
        </div>

        <div class="mb-3">
            <label>Tanggal Booking</label>
            <input type="date"
                   name="tanggal_booking"
                   class="form-control"
                   value="{{ $booking->tanggal_booking }}">
        </div>

        <div class="mb-3">
        Status Pembayaran
            <select name="status_pembayaran" class="form-control">
                <option value="belum"
                    {{ $booking->status_pembayaran == 'belum' ? 'selected' : '' }}>
                    Belum
                </option>
                <option value="lunas"
                    {{ $booking->status_pembayaran == 'lunas' ? 'selected' : '' }}>
                    Lunas
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Perubahan
        </button>

        <a href="{{ route('booking.list') }}"
           class="btn btn-secondary">
            Kembali
        </a>
    </for
