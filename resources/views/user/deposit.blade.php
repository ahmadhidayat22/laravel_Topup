@extends('layouts.user')




@section('container')

<div class=" p-0" style="width: 100%">

    <div class="col-5 rounded p-4 mb-4 w-100" style="; background-color: rgb(75, 75, 75)">
        <div class="d-flex justify-content-between">

            <p class="text-white fs-5 mb-2" >Saldo anda</p>
            <div class="text-white d-flex align-items-baseline gap-2 " >
                <a href="/dashboard/deposit" class="rounded-3 text-center fs-5" style="background-color: #6b6a6a;padding: 4px 8px; color:#a7a7a7"><i class="bi bi-clock"></i></a>
                <a href="/dashboard/deposit/topup" class="rounded-3 text-center text-white px-2 py-1 fs-6" style="background-color: orange;padding: 0px 8px; ">Top Up</a>
  
            </div>
            
        </div>
        <h4 class="mb-0" style="color: orange">Rp {{ number_format(auth()->user()->saldo , 0, '.' , '.') }}</h4>

    </div>
    <h5 class="text-white">Riwayat transaksi</h5>
    <div class="">
        <div class="w-100 border mb-4 p-4 rounded">
            <div class="row  m-0 ">
             
                <div class="col">
                    <label class="text-white mb-2">Status</label>
                    <select class="form-select form-select-sm" aria-label="small select example">
                        <option selected>Semua</option>
                        <option value="1">success</option>
                        <option value="2">pending</option>
                        <option value="3">cancel</option>
                        <option value="3">expired</option>
                      </select>
                </div>
                <div class="col">
                    <label for="tanggalmulai" class="text-white mb-2">Tanggal Mulai</label>
                    <input type="date" name="awal" class="form-control form-control-sm" id="tanggalmulai" aria-label="">
                </div>
                <div class="col">
                    <label for="tanggalakhir" class="text-white mb-2">Tanggal Akhir</label>
                    <input type="date" name="akhir" value="" class="form-control form-control-sm" id="tanggalakhir">
                </div>

              

            </div>
          
            <div class="row  m-0 pt-4   ">
                <div class="col-md-6 ">
                    <label for="search" class="text-white mb-2">Cari</label>
                    <input type="search" class="rounded form-control py-1" style="" name="search" id="search" placeholder="cari">
                </div>
             
              

            </div>
          
            

        </div>


        <div class="w-100">
            <table>
                <thead>
                    <tr>
                        
                        <th>Nomor Invoice</th>
                        <th>Tanggal</th>
                        <th>Metode Pembayaran</th>
                        <th>Harga</th>
                        <th>status</th>
                      </tr>
                </thead>
               
                @if ( count($data) )
                    @foreach ($data as $dt )
                    <tr>
                      
                        <td><a href="/deposit/detailDeposit/{{ $dt->transaction_code }}" style="color: orange">{{ $dt->transaction_code}} </a></td>
                        <td>{{ $dt->transaction_time }}</td>
                        <td class="text-uppercase">{{ $dt->bank }}</td>
                        <td>Rp {{ $dt->transaction_total }}</td>
                       
                        <td><span class="badge  @if ($dt->transaction_status == 'pending')
                            text-bg-primary
                        @elseif ($dt->transaction_status == 'success')
                        text-bg-success
                        @elseif ($dt->transaction_status == 'cancel' || $dt->transaction_status == 'expire' || $dt->transaction_status == 'deny')
                        text-bg-danger
                        @endif"> <a href="/deposit/detailDeposit/{{ $dt->transaction_code }}">{{ $dt->transaction_status }} </a> </span> </td>
                    </tr>
                @endforeach
             
                @else
                <tr class="">
                    <td colspan="9" >
                        <div class=" d-flex flex-column align-items-center justify-content-center" style="height: 300px;">
                            <h2 class="fs-1"><i class="bi bi-bar-chart"></i></h2>
                            <p>Tidak ada data transaksi !</p>
                        </div>
        
                    </td>
                
                </tr>
                
                @endif
                
                
              </table>
              <div class="d-flex justify-content-end mt-3">
                  {{ $data->links() }}

            </div>
        </div>
       
             
    </div>
    
</div>


@endsection