<div class="board-user d-flex " style="width: 350px; ">
    <div class="list-group d-flex gap-2 w-100" style="border-radius: 0">
        <a href="/dashboard" class="rounded {{ Route::currentRouteNamed('dashboard') ? 'aktif' : 'text-light' }} " aria-current="true"><i class="bi bi-house-door"></i>Dashboard
        </a>
        <a href="/dashboard/transaksi" class="rounded {{ Route::currentRouteNamed('transaksi') ? 'aktif' : 'text-light' }} "><i class="bi bi-clock"></i>Transaksi</a>
        <a href="/dashboard/deposit" class="rounded {{ Route::currentRouteNamed('deposit') ? 'aktif' : 'text-light' }} "><i class="bi bi-bank2"></i>Deposit</a>
        <a href="/dashboard/mutasi" class="rounded {{ Route::currentRouteNamed('mutasi') ? 'aktif' : 'text-light' }} "><i class="bi bi-arrow-repeat"></i>Mutasi</a>
        <a href="/dashboard/laporan" class="rounded {{ Route::currentRouteNamed('laporan') ? 'aktif' : 'text-light' }} "><i class="bi bi-clipboard2-data"></i>Laporan</a>
        <form action="/logout" method="post">
          @csrf
          <button class="rounded w-100 d-flex gap-2 ps-2" style="color: rgb(214, 0, 0); background: transparent"><i class="bi bi-box-arrow-left"></i>keluar</button>
        </form>
      </div>
</div>