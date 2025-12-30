<link rel="stylesheet" href="style/hdr.css">
<header class="site-headerss">
  <div class="headerss-inner">

    <!-- Logo -->
    <div class="headerss-logo">
      <span class="logo-box">Zona Elo</span>
    </div>

    <!-- Menu -->
    <nav class="headerss-menu">
      <a href="{{route('beranda.index')}}">Beranda</a>
      <a href="{{route('katalog.index')}}">Katalog</a>
      <a href="{{route('ulasan.index')}}">Ulasan</a>
    </nav>

    <!-- Actions -->
    <div class="headerss-actions">
    <form action="{{route ('booking.list')}}">
        @csrf
        <button type="submit" class="btnn btnn-primary">Lihat Daftar Pesanan</button>
    </form>
    <form action="{{route ('profil.index')}}">
        @csrf
        <button type="submit" class="btnn btnn-primary">Profil Saya</button>
    </form>
    
    </div>

  </div>
</header>
