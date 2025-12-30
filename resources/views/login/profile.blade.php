<link rel="stylesheet" href="style/profile.css">
<!DOCTYPE html>
<html lang="id">
<head>
<a href="/beranda" class="btn-back">← Kembali</a>
    <meta charset="UTF-8">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
</head>
<body>

<div class="container">
    <h2>Profil Pengguna</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <!-- READ + UPDATE -->
    <form action="{{ route('profil.update') }}" method="POST">
        @csrf

        <label>Nama</label>
        <input type="text" name="name" value="{{ $user->name }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}">

        <label>Nomor Handphone</label>
        <input type="number" name="no_hp" value="{{ $user->no_hp }}">

        <label>Password Baru (Opsional)</label>
        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">

        <button type="submit" class="btn-update">Update Profil</button>
    </form>

    <!-- DELETE -->
    <form action="{{ route('profil.delete') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun?')">
        @csrf
        <button type="submit" class="btn-delete">Hapus Akun</button>
    </form>
    <form action="{{route ('logout')}}" method="post">
        @csrf
        <button type="submit" class="btnn btnn-primary">Logout</button>
    </form>
</div>

</body>
</html>
