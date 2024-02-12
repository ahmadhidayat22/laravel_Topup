@extends('layouts.user')

@section('container')
<div class=" p-0" style="width: 100%">

    <div class="text-white p-0" style="width: 100%">
        <h5 >Laporan</h5>
        <p>Menampilkan data Laporan total penjualan</p>
        <div class="">
            <div class="w-100 border mb-4 p-4 rounded">
                <div class="row  m-0 ">
                    <div class="col">
                        <label class="text-white mb-2">Produk</label>
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
              

              
                
    
            </div>
    
    
            <div class="w-100">
                <table>
                    <thead>
                        <tr>
                           
                            
                            <th>Tanggal</th>
                            <th>Total Transaksi</th>
                            <th>Total Jumlah</th>
                            
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
    
</div>


@endsection