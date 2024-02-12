@extends('layouts.user')



@section('container')


<div class=" container-fluid  p-0">
    <a href="/dashboard/deposit" class="text-white d-flex gap-2"><i class="bi bi-arrow-left"></i>Riwayat deposit</a>
    <div class=" mt-3 text-white">
        <p >Terima kasih</p>

        @if ($data->transaction_status == 'success' ) 
        
        <h3 id="judul">Pembayaran Sukses</h3>
        <p id="keterangan">deposit kamu {{ $data->transaction_code }} telah selesai</p>

        @elseif ($data->transaction_status == 'cancel')
        <h3 id="judul">Pembayaran Gagal</h3>
        <p id="keterangan">deposit kamu {{ $data->transaction_code }} telah dibatalkan</p>

        @else

        <h3 id="judul">Harap Lengkapi Pembayaran</h3>
        <p id="keterangan">deposit kamu {{ $data->transaction_code }} menunggu pembayaran sebelum dikirim</p>
        @endif
    
    </div>
    <div class="mt-3 d-flex justify-content-between" style="border-bottom: 1px solid #929292e5">
        <div class=" p-2 mb-3 text-white">
            <p>Nomor Invoice</p>
            <button type="button" class="p-1 rounded pe-3 position-relative" onclick="myFunction(myInput)" style="background-color: #494949e5; border:1px solid #7e7e7ee5" >
                <i class="bi bi-clipboard" id="icon" style="right: 5px;z-index:2;position:absolute; color:white"></i>
                <fieldset disabled> 
                    <input type="text" style="z-index:-1;background: transparent;color:white" class="" value="{{ $data->transaction_code }}" id="myInput" aria-label="readonly input example" >
                </fieldset>
            </button>
        
        </div>
        <div  class="countdown text-white px-3">

            @php
                
            date_default_timezone_set('Asia/Makassar');
            $now = new Datetime(date('Y-m-d H:i:s'));

            $expired = new DateTime($data->transaction_expired);
            $diff = $now->diff($expired);

            $selisih_tahun = $diff->y;
            $selisih_bulan = $diff->m;
            $selisih_hari = $diff->d;
            $selisih_jam = $diff->h;
            $selisih_menit = $diff->i;
            $selisih_detik = $diff->s;

            // dd ($diff);
            // dd($selisih_tahun, $selisih_bulan, $selisih_hari, $selisih_jam, $selisih_menit, $selisih_detik) ;
        @endphp
            @if ($data->transaction_status == 'pending') 
               
                <p class="mb-1 countdown-text">lengkapi pembayaran sebelum</p>
            <div class="rounded  p-1" id="countdown" style="font-size: 13px; background-color: #c70000">{{ $selisih_hari }} day {{ $selisih_jam }} Hours {{ $selisih_menit }} Minute {{ $selisih_detik }} Second</div>
           
            @else
            <p class="mb-1 countdown-text" style="font-size: 18px;color:white;">Transaksi dibuat pada</p>
            <p class="mb-1 countdown-text" style="font-size: 15px;color:orange;">{{ $data->transaction_time }}</p>
            
            @endif

        </div>

    </div>
    <div class="p-2 mt-3 text-white" style="border-bottom: 1px solid #929292e5">
        <div class="my-3">

            <p class="m-0">Metode Pembayaran</p>
            <p class="m-0 text-uppercase " style="font-size: 12px">bank {{ $data->bank }}</p>
        </div>

    </div>
    <div class="p-2 mt-3 text-white" style="border-bottom: 1px solid #929292e5">
        <div class="my-3 row   m-0" >
            <div class="col  " >

                <p class="m-0">Nama Rekening</p>
                <p class="mt-2">Nomor Rekening</p>

            </div>
            <div class="col " >
                <p class="m-0" >Play Point Plus</p>
                <button type="button" class="p-1 mt-2 rounded pe-3 position-relative" onclick="myFunction(myInput2)" style="background-color: #494949e5; border:1px solid #7e7e7ee5"><i class="bi bi-clipboard" id="icon" style="right: 5px;z-index:2;position:absolute;color:white"></i>
                    <fieldset disabled> 
                        <input type="text" style="z-index:-1;background: transparent;color:white" class=""  value="{{ $data->va_number }}" id="myInput2" aria-label="readonly input example">
                    </fieldset>
                </button>
            </div>
        </div>
    </div>
    <div class="p-2 mt-3 text-white" style="border-bottom: 1px solid #929292e5">
        <div class="my-3 row  m-0" >
            <div class="col  " >

                <p class="m-0">Status Pembayaran</p>
            </div>
            <div class="col " >
                <span class="badge  @if ($data->transaction_status == 'pending')
                    text-bg-primary
                @elseif ($data->transaction_status == 'success')
                text-bg-success
                @elseif ($data->transaction_status == 'cancel' || $data->transaction_status == 'expire' || $data->transaction_status == 'deny')
                text-bg-danger
                @endif">{{ $data->transaction_status }} </span>
                
            </div>
        </div>
    </div>
    <div class=" p-2 mt-3 text-white" style="border-bottom: 1px solid #929292e5">
        <div class="my-3 row   m-0" >
            <div class="col " >

                <p class="m-0">Total</p>
            </div>
            <div class="col " style="text-align: right" >
                <p>Rp {{ number_format( $data->transaction_total , 0, '.' , '.') }}</p>
                
            </div>
        </div>
    </div>
    <div class=" p-2 mt-3 text-white" style="border-bottom: 1px solid #929292e5">
        <div class="my-3 row   m-0" >
            <div class="col " >

                <p class="m-0" style="font-size: 20px">Total Pembayaran</p>
            </div>
            <div class="col " style="text-align: right" >
                <button type="button" class="p-1 mt-2 rounded position-relative" onclick="myFunction(myInput3)" style="background-color: #494949e5; border:1px solid #7e7e7ee5"><i class="bi bi-clipboard" id="icon" style="right: 5px;z-index:2;position:absolute;color:orange"></i>
                    <fieldset disabled> 
                        <label for="myInput2" class="ps-2" style="color: orange;font-weight: 800">Rp</label>
                        <input type="text" style="max-width: 150px; background: transparent; color: orange; font-weight: 800" class="" value="{{ $data->transaction_total}}" id="myInput3" aria-label="readonly input ">
                    </fieldset>
                </button>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   function myFunction(id) {
        var copyText = id;
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);

        
        Swal.fire({
            text : copyText.value + ' copied to clipboard',
            icon : "success"
        });
    }
    $(document).ready(function(){
        var hari = <?php echo $selisih_hari; ?>;
        var jam = <?php echo $selisih_jam; ?>;
        var menit = <?php echo $selisih_menit; ?>;
        var detik = <?php echo $selisih_detik; ?>;
        
        let countdown = setInterval(() => {
            detik--;
            if(detik < 0){detik=59;menit--;};
            if(menit < 0){menit=59;jam--;};
            if(jam < 0){jam=23;hari--;};
            
          

            $('#countdown').html(hari + ' day ' + jam + ' Hours ' + menit + ' Minute ' + detik + ' Second ')

            if(hari == 0 && jam == 0 && menit == 0 && detik == 0){
                $('.countdown-text').remove();
                $('#countdown').remove();
                $('.countdown').append('<p class="mb-1 countdown-text" style="font-size: 18px;color:white;">Transaksi dibuat pada</p>');
                $('.countdown').append('<p class="mb-1 countdown-text" style="font-size: 15px;color:orange;"> <?php echo $data->transaction_time; ?> </p>');
                $('#judul').html('Deposit telah selesai');
                $('#keterangan').html('deposit kamu <?php echo $data->transaction_code; ?> telah selesai');
                clearInterval(countdown);
            };
            

        }, 1000);
        
        


    })
</script>


@endsection