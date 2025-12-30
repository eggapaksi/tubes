<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pesanan</title>

    <!-- CSS -->
    <a href="/katalog" class="btn-back">← Kembali</a>
    <link rel="stylesheet" href="{{ asset('style/list.css') }}">
</head>
<body>

<div class="container">
    <h2>📋 Data Pesanan</h2>

    <table>
        <thead>
        <tr>
            @if($user->role === 'admin')
                <th>Nama Pemesan</th>
            @endif
            <th>Nama Katalog</th>
            <th>Jumlah</th>
            <th>Tanggal Booking</th>

            @if($user->role === 'admin')
                <th>Total Biaya</th>
                <th>Catatan</th>
                <th>Metode Pembayaran</th>
            @endif

            <th>Status Pembayaran</th>
            <th>Aksi</th>
        </tr>
        </thead>

        <tbody>
        @foreach($bookings as $b)
            <tr>
                @if($user->role === 'admin')
                    <td>{{ $b->nama_pemesan }}</td>
                @endif

                <td>{{ $b->nama_katalog }}</td>
                <td>{{ $b->jumlah }}</td>
                <td>{{ $b->tanggal_booking }}</td>

                @if($user->role === 'admin')
                    <td>Rp {{ number_format($b->total_biaya) }}</td>
                    <td>{{ $b->catatan }}</td>
                    <td>{{ $b->metode_pembayaran }}</td>
                @endif

                <td>
                    <span class="status {{ $b->status_pembayaran === 'lunas' ? 'paid' : 'pending' }}">
                        {{ $b->status_pembayaran ?? 'pending' }}
                    </span>
                </td>

                <td>
                    <div class="aksi-btn">
                        <form action="{{ route('booking.edit', ['id' => $b->id_booking]) }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-edit">
                                Edit
                            </button>
                        </form>
                        <form action="{{ route('booking.destroy', ['id' => $b->id_booking]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-delete"
                                    onclick="return confirm('Batalkan pesanan ini?')">
                                Batal
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
