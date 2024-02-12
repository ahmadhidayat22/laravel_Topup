@extends('layouts.user')


<style>
    .bank:checked+label {

        background-color: #fff;

        .check {
            display: block !important;
        }

        .p-2 img {
            filter: grayscale(0) !important;

        }

        .total {
            color: orange !important;
        }

    }
</style>
@section('container')
<div class=" container-fluid  p-0">
    <a href="/dashboard/deposit" class="text-white d-flex gap-2"><i class="bi bi-arrow-left"></i>Riwayat deposit</a>
    <div class=" px-4" style="width: 43rem">


        <div class="border  my-2 rounded">
            <h4 class="text-white m-4">Jumlah Top Up</h4>
            <hr class="text-white">
            {{-- <form action="{{ route('midtrans') }}" method="post">
                @csrf --}}
                <div class="d-flex flex-column  m-4 gap-2">
                    <label for="jumlah" class="text-white">Jumlah</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp</span>
                        <input type="text" id="jumlah" name="jumlah" class="form-control"
                            aria-label="Amount (to the nearest dollar)" type-currency="IDR">
                    </div>

                </div>
        </div>

        <div class="border mt-4 mb-2 rounded">
            <div class="p-4">
                <h4 class="m-0 text-white">Metode Pembayaran</h4>
            </div>
            <hr>
            <div class="row  m-0 p-3 gap-3">

                <div class=" position-relative col-3 col-lg-3 p-0 rounded"
                    style="background-color: rgb(151, 151, 151); height: 90px;">
                    <input type="radio" name="bank" id="bank" class="bank" style="width: 100%;height:100%;position: absolute;display: none; " name="bank" value="bri" onclick="getValue('bri')" data-value = 'bri'>
                    <label for="bank" class=""style="width:100%;height:100%;cursor: pointer;border-radius: 5px;">
                        <span class="check position-absolute fs-4 d-none"
                            style="right: 10px; top:10px;color:rgb(0, 110, 255)"><i
                                class="bi bi-check-circle-fill"></i></span>
                        <div class="p-2 parent">

                            <p class="m-0">Bank BRI</p>
                            <p class="m-0 " style="font-size: 10px">dicek Otomatis</p>
                            <p class="total m-0 " style="font-size: 12px; ">Rp 0</p>
                            <img src="{{ asset('img/BRI.png') }}" alt=""
                                style="max-width: 40px; position:absolute; bottom:10px; right: 20px;filter: grayscale(1)">
                        </div>
                    </label>

                </div>
                <div class="parent position-relative col-3 col-lg-3 p-0 rounded"
                    style="background-color: rgb(151, 151, 151); height: 90px;">
                    <input type="radio" name="bank" id="bank1" class="bank" 
                        style="width: 100%;height:100%;position: absolute;display: none; " name="bank" value="bca" data-value = 'bca'
                        onclick="getValue('bca')">
                    <label for="bank1" class=""
                        style="width:100%;height:100%;cursor: pointer;border-radius: 5px; ">
                        <span class="check position-absolute fs-4 d-none"
                            style="right: 10px; top:10px;color:rgb(0, 110, 255)"><i
                                class="bi bi-check-circle-fill"></i></span>
                        <div class="p-2 parent">

                            <p class="m-0">Bank BCA</p>
                            <p class="m-0 " style="font-size: 10px">dicek manual</p>
                            <p class="total m-0" style="font-size: 12px">Rp 0</p>
                            <img src="{{ asset('img/BCA.png') }}" alt=""
                                style="max-width: 40px; position:absolute; bottom:10px; right: 20px;filter: grayscale(1)">
                        </div>

                    </label>

                </div>
                <div class="parent position-relative col-3 col-lg-3 p-0 rounded"
                    style="background-color: rgb(151, 151, 151) ;height: 90px;">
                    <input type="radio" name="bank" id="bank2" class="bank"
                        style="width: 100%;height:100%;position: absolute;display: none; " name="bank" value="bni" data-value = 'bni'
                        onclick="getValue('bni')">
                    <label for="bank2" class=""
                        style="width:100%;height:100%;cursor: pointer;border-radius: 5px; ">
                        <span class="check position-absolute fs-4 d-none"
                            style="right: 10px; top:10px;color:rgb(0, 110, 255)"><i
                                class="bi bi-check-circle-fill"></i></span>
                        <div class="p-2 parent">

                            <p class="m-0">Bank BNI</p>
                            <p class="m-0 " style="font-size: 10px">dicek manual</p>
                            <p class="total m-0" style="font-size: 12px">Rp 0</p>
                            <img src="{{ asset('img/BNI.png') }}" alt=""
                                style="max-width: 40px; position:absolute; bottom:10px; right: 20px;filter: grayscale(1)">
                        </div>

                    </label>

                </div>
                <div class="position-relative col-3 col-lg-3 p-0 rounded"
                    style="background-color: rgb(151, 151, 151); height: 90px;">
                    <input type="radio" name="bank" id="bank3" class="bank" 
                        style="width: 100%;height:100%;position: absolute;display: none; " name="bank" value="mandiri" data-value = 'mandiri'
                        onclick="getValue('mandiri')">
                    <label for="bank3" class=""
                        style="width:100%;height:100%;cursor: pointer;border-radius: 5px; ">
                        <span class="check position-absolute fs-4 d-none"
                            style="right: 10px; top:10px;color:rgb(0, 110, 255)"><i
                                class="bi bi-check-circle-fill"></i></span>
                        <div class="p-2 parent ">

                            <p class="m-0">Bank MANDIRI</p>
                            <p class="m-0 " style="font-size: 10px">dicek manual</p>
                            <p class="total m-0" style="font-size: 12px">Rp 0</p>
                            <img src="{{ asset('img/MANDIRI.png') }}" alt=""
                                style="max-width: 40px; position:absolute; bottom:10px; right: 20px;filter: grayscale(1)">
                        </div>

                    </label>

                </div>



            </div>

        </div>
        
        {{-- <input type="hidden" id="" class="d-none"  value="{{ auth()->user()->id }}" name="id_user"> --}}
        
        <button type="submit" class=" my-4 rounded p-1 " id="submit" style="width: 100%;color:black; background-color: #00b7ff">Top up Sekarang</button>
        
        {{-- </form> --}}
        
    </div>
    
    
    <input type="text" class="d-none" id="banks" value="">
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        
        function getValue(e) {
           $('#banks').val(e);
    
        }
       

        
        
        
       
        // $(".bank").on("click", function() {
        // value = $(this).attr("data-value");
        // window.value = value;
        // });

        // Akses variabel value setelah ditambahkan ke objek window

        // Akses variabel value dari mana saja di halaman
        
        $(document).ready(function(){
           
            $('#submit').on('click', function(e){
                   

                let bank = $("#banks").val();
                e.preventDefault;
                $('#submit').text('loading...');
                
                let ammount = $('#jumlah').val();
                let split = ammount.split('.');
                let ammount_ = split.join("");
              
                $.ajax({
                    url: "{{ route('Deposit') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    data: {
                        ammount: ammount_,
                        type: 'deposit',
                        bank: bank
                    
                    },
                    success: function (name) {
                        // alert(message);
                        // console.log(name.order_id);
                    
                        Swal.fire({
                            text: "Permintaan Deposit berhasil dibuat",
                            icon : "success"
                        });
                        setInterval(() => {
                            window.location.href = "{{ url('/dashboard/deposit/') }}";
                            
                        }, 1000);
                    },
                    error: function(err){
                        console.log(err.statusText);
                        Swal.fire({
                            text: err.statusText,
                            icon : "error"
                        }); 
                        $('#submit').text('Top up Sekarang');
                    }
                    
                 });

            })
        });


        document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
            element.addEventListener('keyup', function(e) {
                let cursorPostion = this.selectionStart;
                let value = parseInt(this.value.replace(/[^,\d]/g, ''));
                let originalLenght = this.value.length;
                if (isNaN(value)) {
                    this.value = "";
                } else {

                    let dataformated = new Intl.NumberFormat('en-DE').format(value);


                    this.value = dataformated;
                    //   this.value = value.toLocaleString('id-ID', {
                    //     currency: 'IDR',
                    //     style: 'currency',
                    //     minimumFractionDigits: 0
                    //   });
                    //   cursorPostion = this.value.length - originalLenght + cursorPostion;
                    //   this.setSelectionRange(cursorPostion, cursorPostion);
                    $('.total').remove();
                    $('.parent').append("<p class='total m-0' style='font-size: 12px'>Rp " + dataformated +
                        " </p>")
                }
            });
        });

        
    </script>
@endsection
