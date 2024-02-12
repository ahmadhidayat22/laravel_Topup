@extends('layouts.main')


@section('container')

<div class="container  mt-5 text-white" >
    <p class="m-0" style="color: #ffc107">Thank you!</p>
    {{-- <h1 class="fw-bolder">Please complete the payment</h1>
    <p class="m-0">your order {{ $data->transaction_code }} is waiting for payment before it is sent</p> --}}


    @if ($data->transaction_status == 'success' ) 
        
    <h1 class="fw-bolder" >Payment Success</h1>
    <p class="m-0">your order {{ $data->transaction_code }}  will be sent to your account</p>

    @elseif ($data->transaction_status == 'cancel')
    <h1 class="fw-bolder" >Payment Failed</h1>
    <p class="m-0">deposit kamu {{ $data->transaction_code }} has been cancelled</p>

    @else

    <h1 class="fw-bolder" >Please complete the payment</h1>
    <p class="m-0">your order {{ $data->transaction_code }} is waiting for payment before it is sent<</p>
    @endif


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
        
    <div class="mt-4 ">
        <div class="" style="width: 300px">
            <p class="m-0 mb-1">This order will expire on</p>
            <div class="rounded p-2" id="countdown" style="font-size: 14px; background-color: #db2543"> {{ $selisih_jam }} Hours {{ $selisih_menit }} Minute {{ $selisih_detik }} Second</div>
        </div>
    </div>
    @else
    <div class="mt-4 ">
        <p class="mb-1 countdown-text" style="font-size: 18px;color:white;">Transaksi dibuat pada</p>
        <p class="mb-1 countdown-text" style="font-size: 15px;color:#ffc107;">{{ $data->transaction_time }}</p>
    </div>
    @endif


    <hr class="text-white">
    <div class=" row" >
        <div class=" col" >
           <div class=" d-flex p-3 gap-4 mb-4">

                <div class="rounded overflow-hidden" style="aspect-ratio: 4 / 6;height:12rem" >
                    <img decoding="async"  src="{{ asset('img/pubg.png') }}" class="card-img-top" style="object-fit: cover; height:100%;width: 100%" alt="...">
                    
                </div>
                
                <div class="">
                    {{-- <p class="m-0">{{ $product }}</p> --}}
                    <h5 class="m-0">{{ $product->nama }}</h5>
                    <p class="m-0" style="font-size: 15px">300 UC</p>
                    <p class="m-0 mt-3" style="font-size: 15px">ID : {{ $data->transaction_number }}</p>
                </div>
            </div>
            <div class=" ">
               <div class="d-flex justify-content-between px-3">
                <p class="m-0">Price</p>
                <p class="m-0">Rp {{number_format($data->transaction_total, 0, '.' ,'.') }}</p>
               </div>
               
               <div class="d-flex justify-content-between px-3">
                <p class="m-0">Fee</p>
                <p class="m-0">Rp ..0</p>
               </div>
               <hr class="mx-3">
               <div class="d-flex justify-content-between px-3">
                    <h4 class="fw-bolder">Total Payment</h4>
                    
                    <button type="button" class="p-1 rounded pe-1 position-relative" onclick="myFunction(myInput1)" style="background-color: #494949e5; border:1px solid #7e7e7ee5" >
                        <i class="bi bi-clipboard " id="icon" style="right: 5px;z-index:2;position:absolute; color:white"></i>
                        <fieldset disabled> 
                            <input type="text" style="z-index:-1;background: transparent;color:white;width: 150px" class="" value="Rp {{number_format($data->transaction_total, 0, '.' ,'.') }}" id="myInput1" aria-label="readonly input example" >
                        </fieldset>
                    </button>
               </div>
            </div>
        </div>
        <div class=" col" >
            <div class="d-flex justify-content-between mt-2"> 

                <div>
                    
                    <p class="m-0">Payment Method</p>
                    <p class="m-0">{{ ($data->bank == 'echannel') ? 'Mandiri Virtual Account' : $data->bank }}</p>
                    
                </div>
                @if ($data->qr_code != '-' && $data->transaction_status != 'success')
                    <div class="rounded overflow-hidden" style="height:10rem;" >
                        
                        <img decoding="async"  src="{{ $data->qr_code }}" class="card-img-top" style="object-fit: cover; height:100%;width: 100%" alt="">
                        
                    </div>
                @else

                @endif
                
            </div>
            <hr>

            <div class="row ">
                <div class="col d-flex flex-column gap-3">
                    @if ($data->va_number != '-')
                    <div>
                        <p class="m-0">Invoice Number</p>

                    </div>
                    @endif
                    <div>
                        <p class="m-0">Transaction Status</p>
                    </div>
                    <div>
                        <p class="m-0">Payment status</p>
                    </div>

                </div>
                <div class="col d-flex flex-column gap-3">
                    @if ($data->va_number != '-')
                    <div class="">
                        <button type="button" class="px-1 rounded pe-1 position-relative" onclick="myFunction(myInput2)" style="background-color: #494949e5; border:1px solid #7e7e7ee5" >
                            <i class="bi bi-clipboard " id="icon" style="right: 5px;z-index:2;position:absolute; color:white"></i>
                            <fieldset disabled> 
                                <input type="text" style="z-index:-1;background: transparent;color:white;min-width: 150px" class="" value="{{ $data->va_number }}" id="myInput2" aria-label="readonly input example" >
                            </fieldset>
                        </button>
                    </div>
                        
                    @endif

                    <div class="badge rounded @if ($data->transaction_status == 'pending') text-bg-primary
                    @elseif ($data->transaction_status == 'success') text-bg-success
                    @elseif ($data->transaction_status == 'cancel' || $data->transaction_status == 'expire' || $data->transaction_status == 'deny') text-bg-danger
                    @endif " style="width: 60px">{{ $data->transaction_status }}</div>

                    <div class="badge rounded text-bg-primary"  style="width: 60px">Primary</div>
                </div>
                
            </div>

            @if ($data->transaction_status == 'success')
                
            <div class="alert alert-success mt-4" role="alert">
                Pembayaran telah berhasil
                
            </div>
            @elseif ($data->qr_code != '-')
            <div class="mt-4">
                
                {{-- <a href="{{ $data->deeplink_redirect }}"> --}}
                    <button type="button" id="redirect" class="btn  d-flex align-items-baseline gap-3 fw-bolder text-white" style="background-color: #eca319;">Click here to pay <i class="bi bi-box-arrow-up-right" ></i></button>
                    {{-- </a> --}}
            </div>
            <small style="color: #cccccc">* you can pay with a qr code or press the "click here to pay" button</small>
            @else
            <div class="alert alert-danger mt-4" role="alert">
                Mohon transfer sesuai dengan jumlah yang tertera
                
              </div>
            @endif
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
    };
    $(document).ready(function(){
        let data =`<?= $data->deeplink_redirect ?>`
        console.log(data);
       $('#redirect').click(() => {
        window.location.href = data;
       })

        let hari = <?php echo $selisih_hari; ?>;
        let jam = <?php echo $selisih_jam; ?>;
        let menit = <?php echo $selisih_menit; ?>;
        let detik = <?php echo $selisih_detik; ?>;
        
        let countdown = setInterval(() => {
                detik--;
                if(detik < 0){detik=59;menit--;};
                if(menit < 0){menit=59;jam--;};
                if(jam < 0){jam=23;hari--;};
                // detik--;
                // detik %= 60;
                // menit--;
                // menit %= 60;
                // jam--;
                // jam %= 24;
          
            
            $('#countdown').html( jam + ' Hours ' + menit + ' Minute ' + detik + ' Second ')

            if(hari == 0 && jam == 0 && menit == 0 && detik == 0){
                    $('#countdown').html('0 Hours 0 Minute 0 Second')
                    clearInterval(countdown);
                };
            
            
        }, 1000);


            
        });


    

</script>


@endsection