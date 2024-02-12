@extends('layouts.user')


@section('container')

<div class=" p-0" style="width: 100%">
    <h5 class="text-white">Riwayat transaksi</h5>
    <div class="">
        <div class="w-100 border mb-4 p-4 rounded">
            <div class="row  m-0 ">
                <div class="col">
                    <label class="text-white mb-2">Status Transaksi</label>
                    <select class="form-select form-select-sm" aria-label="small select example">
                        <option selected>Semua</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                </div>
                <div class="col">
                    <label class="text-white mb-2">Status Pembayaran</label>
                    <select class="form-select form-select-sm" aria-label="small select example">
                        <option selected>Semua</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
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
                  <td colspan="9" >
                    <div class=" d-flex flex-column align-items-center justify-content-center" style="height: 300px;">
                        <h2 class="fs-1"><i class="bi bi-bar-chart"></i></h2>
                        <p>Tidak ada data transaksi !</p>
                    </div>
    
                  </td>
                 
                </tr>
                
                
              </table>
        </div>
       
             
    </div>
    
</div>



@endsection