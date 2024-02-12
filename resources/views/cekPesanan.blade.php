@extends('layouts.main')

@section('container')
    <div class="container " style="width: 60%">
        <h4 class="text-white">Cek Status Pemesanan</h4>
        

        <div class="container mt-3 position-relative border p-3 rounded bg-dark text-white" style="width: 90%; height: 11rem;">
            <p class="">No. Pesanan</p>
            
            <form action="/cekPesanan/bayar">

                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded" name="keyword" placeholder="ID trx" aria-label="" aria-describedby="button-addon2">
                </div>
                <button type="submit" id="btn-search" class="btn btn-primary position-absolute bottom-2" style="right: 1rem; width: 190px">Cek Pesanan</button>
            </form>
         
        </div>

        <div>
            
        </div>

    </div>

    <script>

        // $('#btn-search').click(function(){
        //     let keyword = $('input[name="keyword"]').val();
        //     console.log(keyword);
        //     // window.location.href = '/cekPesanan/bayar?keyword='+keyword;


        //     // $.ajax({
        //     //     url: "/cekPesanan/bayar",
        //     //     type: "POST",
        //     //     headers: {
        //     //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     //         },
        //     //         dataType: "json",
        //     //     data: {
        //     //             keyword: keyword
                    
        //     //         },
        //     //     success: function(res){

        //     //         console.log(res);
        //     //     }


        //     // });

        // });


    </script>

@endsection
