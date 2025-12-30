<link rel="stylesheet" href="style/register.css">
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>

</head>
<body>

<div class="register-box">
    <h2>Registrasi Akun</h2>

    <form action="{{ route('register.proses') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        
        <input type="number" name="no_hp" placeholder="Nomor Handphone" value="{{ old('no_hp') }}">
        @error('no_hp') <div class="error">{{ $message }}</div> @enderror

        <input type="password" name="password" placeholder="Password">
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password">

        <button type="submit">Daftar</button>
    </form>

    <div class="login-link">
        Sudah punya akun? <a href="{{ route('loginProses') }}">Login</a>
    </div>
</div>

</body>
</html>
