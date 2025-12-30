<link rel="stylesheet" href="style/login.css">
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Zona Elo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="login.css">
</head>
<body>


<div class="login-page">

    <div class="login-card">
        <h2>Login</h2>
        <p class="subtitle">Silakan masuk ke akun Anda</p>

        <form action="{{route('loginProses')}}"method="post">
        @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email...">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password...">
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form> 

        <p class="footer-text">
            Belum punya akun?
            <a href={{ route('register') }}>Daftar</a>
        </p>
    </div>

</div>

</body>
</html>

