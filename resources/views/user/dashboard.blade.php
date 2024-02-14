@extends('layouts.user')

@section('container')

<div class=" p-0" style="width: 100%">
    <div class="row  gap-5 w-100 m-0" >
        <div class="col-6  gap-2 p-0 rounded" style=" background-color: rgb(75, 75, 75)">
            <div class="d-flex ">

                
                <div class="w-100 m-0" style="position: relative;">
                    <div class=" p-3" style="width:100%; height:100px">
                    <h5 class="text-white">nama lengkap</h5>
                    <p class="text-white">email</p>
                    {{-- <span class="badge text-bg-primary">Primary</span> --}}
                    </div>


                    <a href="#" class="rounded-3 text-center text-white fs-5" style="position: absolute; ;background-color: #757575;padding: 2px 6px; top:20px; right: 20px"><i class="bi bi-gear"></i></a>

                     </div>
            </div>
                
            <hr class="text-white my-1">
            <div class="" style="">
                <p class="text-white d-flex align-items-baseline gap-2  ms-4"><i class="bi bi-telephone fs-5"></i>08235823948</p>
            </div>

        </div>
        <div class="col-5 rounded px-4 py-3" style="max-height: 110px ; background-color: rgb(75, 75, 75)">
            <div class="d-flex justify-content-between">

                <p class="text-white fs-5">Saldo anda</p>
                <div class="text-white d-flex align-items-baseline gap-2 " >
                    <a href="/dashboard/deposit" class="rounded-3 text-center  fs-5" style="background-color: #6b6a6a;padding: 0px 8px; color:#a7a7a7 "><i class="bi bi-clock"></i></a>
                    <a href="#" class="rounded-3 text-center text-white px-2 py-1 fs-6" style="background-color: orange;padding: 0px 8px; ">Top Up</a>

                    
                </div>
                
            </div>
            <h4 class="" style="color: orange">Rp {{ number_format(auth()->user()->saldo , 0, '.' , '.') }}</h4>
            
        </div>
        
    </div>
    <h5 class="text-white mt-5">Transaksi Hari Ini</h5>

    <div class="row w-100 m-0 gap-4 ">
        <div class="col rounded text-white d-flex align-items-center justify-content-center flex-column p-3" style=" background-color: rgb(75, 75, 75)">
            <h3 class="">0</h3>
            <p>Total Transaksi</p>
        </div>
        
        <div class="col rounded text-white d-flex align-items-center justify-content-center flex-column p-3" style=" background-color: rgb(75, 75, 75)">
            <h3 class="">0</h3>
            <p>Total Penjualan</p>
        </div>
        
    </div>
    <div class="row w-100 m-0 mt-3 gap-4">

        <div class="col  text-white  d-flex align-items-center justify-content-center flex-column p-3 bg-warning rounded">
            <h3>0</h3>
            <p>Pending</p>
        </div>
        
        <div class="col  text-white  d-flex align-items-center justify-content-center flex-column p-3 bg-primary rounded">
            <h3>0</h3>
            <p>Process</p>
        </div>
        
        <div class="col  text-white  d-flex align-items-center justify-content-center flex-column p-3 bg-success rounded">
            <h3>0</h3>
            <p>Success</p>
        </div>
        
        <div class="col  text-white  d-flex align-items-center justify-content-center flex-column p-3 bg-danger rounded">
            <h3>0</h3>
            <p>Failed</p>
        </div>
        
        
        
    </div>

    <h5 class="mt-4 text-white">Riwayat Transaksi Hari Ini</h5>
    {{-- <div class="card" style="">

    <div class=" text-white table-responsive">

        <table class="w-100 align-middle table table-bordered table-striped table-dark" style="">
            <thead class="" >
                <tr >

                    <th scope="col">No</th>
                    <th scope="col">Nomor Transaksi</th>
                    <th scope="col">ID Trx</th>
                    <th scope="col">Item</th>
                    <th scope="col">SN</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
            <tr style="">
                    <td>1</td>
                    <td>Sdn12412mak</td>
                    <td>12412rwad</td>
                    <td>Mobile Legends 2 diamond</td>
                    <td>12450129124851</td>
                    <td>Rp 3.000</td>
                    <td>
                        <span class="badge text-bg-success">Success</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> --}}

    <div class="w-100">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Invoice</th>
                    <th>Id trx</th>
                    <th>Item</th>
                    <th>SN</th>
                    <th>Harga</th>
                    <th>Harga</th>
                    <th>status</th>
                  </tr>
            </thead>
           
            <tr class="">
              <td colspan="9">
                <div class=" d-flex flex-column align-items-center justify-content-center" style="height: 300px;">
                    <h2 class="fs-1"><i class="bi bi-bar-chart"></i></h2>
                    <p>Tidak ada data transaksi !</p>
                </div>

              </td>
             
            </tr>
            
            
          </table>
    </div>
   
         



</div>

@endsection