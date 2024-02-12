
<nav class="navbar navbar-expand-md  navbar-dark bg-dark sticky-top">
    <div class="container align-items-center d-flex ">
      <a href="/" class="d-flex align-items-center gap-3">
        <img src="{{ ('/img/pointStore.png') }}" style="width: 35px" alt="">
        <h4 class="text-white mt-2">Point Store</h4>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end " id="navbarNavAltMarkup">
        <div class="navbar-nav gap-2">
          <hr class="my-1 text-white">
          <a class="link-utama my-1 {{ Route::currentRouteNamed('home') ? 'text-warning' : 'text-light' }} rounded " y-1 aria-current="page" href="{{ url('/')}}">Beranda</a>
          <a class="link-utama my-1 {{ Route::currentRouteNamed( 'cekpesanan') ? 'text-warning' : 'text-light' }} rounded" href="{{ url('cekPesanan' )}}">Cek pesanan</a>
          <a class="link-utama my-1 me-5 {{ Request::is( 'kalkulator') ? 'text-warning' : 'text-light' }} rounded" href="{{ url('kalkulator')}}">Kalkulator ML</a>
          @auth
          <div class="btn-group profile">
            <button class="btn btn-secondary dropdown-toggle bg-transparent" type="button" data-bs-toggle="dropdown"  aria-expanded="false">
              {{ auth()->user()->username }}
            </button>
            <ul class="dropdown-menu  bg-dark text-white mt-3">
              <p class="p-2">Anda telah login sebagai {{ substr(auth()->user()->email, 0, 20) }}...</p>
              <li><a class=" d-flex gap-2 px-2 text-light" href="/dashboard"><i class="bi bi-house-door"></i>Dashboard</a></li>
              <li><a class=" d-flex gap-2 px-2" href="/dashboard/deposit"><i class="bi bi-cash"></i>Rp {{ substr(number_format(auth()->user()->saldo , 0, '.' , '.') ,0, 10) }}...</a></li>
              <li><a class=" d-flex gap-2 px-2" href="#"><i class="bi bi-gear"></i>Setting</a></li>
              <li><hr class="my-1"></li>
              <form action="/logout" method="post">
                @csrf
                <li class="ini-dropdown ">
                  <button class="d-flex gap-2 px-2 btn-logout"><i class="bi bi-box-arrow-left"></i>Logout</button></li>
              </form>
            </ul>
          </div>
          <hr class="my-1 text-white">

          <a class="ini-dropdown d-none  text-light" href="/dashboard">Dashboard</a>
          <a class="ini-dropdown d-none  text-light" href="/dashboard/transaksi">Transaksi</a>
          <a class="ini-dropdown d-none  text-light" href="/dashboard/deposit">Deposit</a>
          <a class="ini-dropdown d-none  text-light" href="/dashboard/mutasi">Mutasi</a>
          <a class="ini-dropdown d-none  text-light" href="/dashboard/laporan">Laporan</a>
          <hr class="my-1 text-white">

          <a class="ini-dropdown d-none" style="color: rgb(214, 0, 0)" href="/dashboard">keluar</a>
          
            
          @else

          <a class="masuk nav-link text-light ms-4 rounded" href="{{ url('login') }}">Masuk</a>
          <a class="daftar nav-link text-light bg-warning rounded" href="{{ url('login') }}">Daftar</a>
          @endauth
          
        
        </div>
      </div>
    </div>
  </nav>

{{-- 
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container" style="width: 75%">
      <a href="/" class="d-flex align-items-center gap-3">
        <img src="{{ ('/img/pointStore.png') }}" style="width: 35px" alt="">
        <h4 class="text-white mt-2">Point Store</h4>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header bg-dark">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        
        <div class="offcanvas-body bg-dark">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            
            
            <li class="nav-item">
              <a class="nav-link  {{ Route::currentRouteNamed('home') ? 'text-warning' : 'text-light' }} rounded " aria-current="page" href="{{ url('/')}}">Home</a>
            </li>
           <li>
          <a class="nav-link {{ Request::is( 'cekPesanan') ? 'text-warning' : 'text-light' }} rounded" href="{{ url('cekPesanan' )}}">Cek pesanan</a>

           </li>
           <li>
          <a class="nav-link {{ Request::is( 'kalkulator') ? 'text-warning' : 'text-light' }} rounded" href="{{ url('kalkulator' )}}">Kalkulator ML</a>

           </li>
            <li> 
              @auth
              <div class="btn-group profile" style="">
                <button class="btn btn-secondary dropdown-toggle bg-transparent" type="button" data-bs-toggle="dropdown"  aria-expanded="false">
                  {{ auth()->user()->username }}
                </button>
                <ul class="dropdown-menu  bg-dark text-white mt-3">
                  <p class="p-2">Anda telah login sebagai {{ substr(auth()->user()->email, 0, 20) }}...</p>
                  <li><a class="ini-dropdown d-flex gap-2 px-2 text-light" href="/dashboard"><i class="bi bi-house-door"></i>Dashboard</a></li>
                  <li><a class="ini-dropdown d-flex gap-2 px-2" href="#"><i class="bi bi-cash"></i>Rp 0</a></li>
                  <li><a class="ini-dropdown d-flex gap-2 px-2" href="#"><i class="bi bi-gear"></i>Setting</a></li>
                  <li><hr class="my-1"></li>
                  <form action="/logout" method="post">
                    @csrf
                    <li class="ini-dropdown ">
                      <button class="d-flex gap-2 px-2 btn-logout"><i class="bi bi-box-arrow-left"></i>Logout</button></li>
                  </form>
                </ul>
              </div>
              <a class="nav-link text-light rounded" href="/dashboard">{{ auth()->user()->username }}</a>

                
              @else

              <a class="nav-link text-light rounded" href="{{ url('login') }}">Masuk</a>
              <a class="nav-link text-light  rounded" href="{{ url('login') }}">Daftar</a>
              @endauth
            
            </li>

          </ul>
          
        </div>
      </div>
    </div>
  </nav> --}}