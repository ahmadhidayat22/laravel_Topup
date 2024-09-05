@extends('layouts.main')

@section('container')
    <div class="container  d-flex gap-4 py-4" >

        <div class="card  bg-transparent text-white" style="width: 20rem; border-radius: 0;border:none; ">
            {{-- <img src="https://source.unsplash.com/700x400/?game" class="card-img-top" alt="..."> --}}
            <div class="card-body pt-5" style="padding: 0">
                
                <h5 class="card-title mb-3" id="product_name">{{ $product[0]->nama }}</h5>
                {{-- {!! $product[0]->deskripsi !!} --}}

            </div>

        </div>

        <div class="container forum" style="width: 80%">
            {{-- <form > --}}
            {{-- @csrf --}}

            <div class="card text-white bg-dark" style="width: auto;" >
                <div class="card-body">
                    <div class="mb-3">

                        <h4 class="form-label" id="sectionId">Masukkan ID Anda</h4>
                        <div class="d-flex gap-2">

                            <input type="number" class="form-control " name="id" id="id" placeholder="Masukkan ID"
                                style="max-width: 17rem; background-color: rgb(214, 214, 214);border: none" >
                            
                            <label for="zone " class="fs-3 text-black" style="transform: translateX(30px)" >(</label>

                            <input type="number" class="form-control d-inline text-center" name="zone_id" id="server-id" style="width: 10rem;background-color:rgb(214, 214, 214);border:none;"
                            id="zone" placeholder="Server" style="max-width: 5rem" > 
                            <label for="zone" class="fs-3 text-black" style="transform: translateX(-30px)">)</label>
                        </div>

                    </div>
                </div>
            </div>


            <div class="card mt-4 p-3  text-white bg-dark" >

                <h4 id="section1" class="form-label">Masukkan Nominal Top Up</h4>


                <div class="d-flex flex-row flex-wrap mt-3 gap-4" style="">

                 @foreach ($product_detail as $d )
                     
                 <div class="card text-left p-0"  style="width: 180px;background: #d6d6d6;
                 backdrop-filter: blur(20px); ">
                    <input type="radio" name="denom" id="{{ $d->product_sku }}" class="denom variant" data-item="{{ $d->product_denom }}" data-harga="{{ $d->product_buyer_price }}" style="width: 100%;height:100%" value="{{ $d->product_sku }}" onclick="total({{ $d->product_buyer_price }})" > 
                    <label for="{{ $d->product_sku }}" class="denom-label ">
                     
                        
                        <div class="text-denom card-body text-left d-flex p-2 flex-column" style="height: 70px;color: #7a7a7a">
                            <p class="card-title m-0" id="item" style="font-size: 18px">{{ $d->product_denom }}</p>
                            <p class="card-text" style="font-size: 14px">Rp {{ $d->product_buyer_price}}</p>
                            
                        </div>
                        
                    </label>
                  
                </div>
                        
                 @endforeach
                </div>
            </div>



            <div class="card mt-4 p-3 container text-white bg-dark"  style="width: auto; ">
                <h4 id="payment">Pilih Pembayaran</h4>
                <div class="gap-2 d-flex flex-column " >

                    <div class="rounded overflow-hidden " style="">
                        <div id="parent-bayar" class="parent-bayar d-flex justify-content-between px-2 align-items-center"  style=" color:white">
                            <p class="m-0">Account Balance</p>
                            <div id="arrow" class="arrow fs-5 " style="transform: rotate(180deg);transition: all ease-in 0.2s;">
                                <i class="bi bi-chevron-up"></i>
                            </div>
                        </div>

                        <div id="isi" class="isi" style="">

                            @if (auth()->check())
                            <div id="card-isi" class="card-isi rounded-3 p-2 m-2 d-none" style="height: 80px;width:200px; background-color: #cacaca; color:black;transition: all ease-out .9s  ">
                                <p class="m-0" style="font-size: 13px;color: #6d6b6b">Account Balance</p>
                                <p class="mt-1"  style="font-size: 10px;color: #6d6b6b">Your Balance : Rp {{ number_format(auth()->user()->saldo , 0, '.' , '.') }}</p>
          
                            </div>

                            @else
                            <div id="card-isi" class="card-isi rounded-3 p-3 m-2 d-none" style="height: 80px;width:200px; background-color: #b1b1b1; color:black ;transition: all ease-in 3s">
                                <p class="m-0" style="font-size: 13px;color: #6d6b6b">Account Balance</p>
                                <p class="mt-1 m-0"  style="font-size: 10px;color: #6d6b6b">Your Balance : Rp 0</p>
                                <p class="m-0" style="font-size: 10px;color: #6d6b6b">Not Available</p>

                               
                            </div>
                            @endif

                        </div>


                        <div id="logo" class="logo position-relative" style="">
                            <img src="{{ asset('img/pointStore.png') }}" class="position-absolute" alt="" style="height: 20px; right:10px;top:5px">
                        </div>
                    </div>

                    <div class="rounded overflow-hidden " style="">
                        <div id="parent-bayar1" class="parent-bayar d-flex justify-content-between px-2 align-items-center " style="  color:white">
                            <p class="m-0">E-wallet</p>
                            <div id="arrow1" class="arrow fs-5 " style="transform: rotate(180deg);transition: all ease-in 0.2s;">
                                <i class="bi bi-chevron-up"></i>
                            </div>
                        </div>

                        <div id="isi1" class="isi" style="">

                           <div class="d-flex w-100 p-2 gap-2 align-items-center">

                                <div class="text-left p-0 rounded-3" style="height:80px;width: 200px;background: #d6d6d6;
                                backdrop-filter: blur(20px); ">
                                    <input type="radio"  id="dana" class="denom payment"  style="width: 100%;height:100%" name="pembayaran" value="dana" onclick="bayar('dana')"> 
                                    <label for="dana" class="denom-label ">
                                        
                                        
                                        <div class="text-denom card-body text-left d-flex p-2 flex-column" style="height: 70px;color: #7a7a7a">
                                            <p class="m-0" style="font-size: 13px;">DANA</p>
                                            <p class="mt-1 m-0"  style="font-size: 10px;">Biaya Layanan +..%</p>
                                            <p id="total1" class="m-0" style="font-size: 13px;">Rp 0</p>
                                            
                                        </div>
                                        
                                    </label>
                                
                                </div>
                                <div class="text-left p-0 rounded-3" style="height:80px;width: 200px;background: #d6d6d6;
                                backdrop-filter: blur(20px); ">
                                    <input type="radio"  id="OVO" class="denom payment"  style="width: 100%;height:100%" name="pembayaran" value="ovo" onclick="bayar('ovo')" > 
                                    <label for="OVO" class="denom-label ">
                                        
                                        
                                        <div class="text-denom card-body text-left d-flex p-2 flex-column" style="height: 70px;color: #7a7a7a">
                                            <p class="m-0" style="font-size: 13px;">OVO</p>
                                            <p class="mt-1 m-0"  style="font-size: 10px;">Biaya Layanan +..%</p>
                                            <p id="total1" class="m-0" style="font-size: 13px;">Rp 0</p>
                                            
                                        </div>
                                        
                                    </label>
                                
                                </div>
                                <div class="text-left p-0 rounded-3" style="height:80px;width: 200px;background: #d6d6d6;
                                backdrop-filter: blur(20px); ">
                                    <input type="radio"  id="gopay" class="denom payment"  style="width: 100%;height:100%" name="pembayaran" value="gopay" onclick="bayar('gopay')"> 
                                    <label for="gopay" class="denom-label ">
                                        
                                        
                                        <div class="text-denom card-body text-left d-flex p-2 flex-column" style="height: 70px;color: #7a7a7a">
                                            <p class="m-0" style="font-size: 13px;">GOPAY</p>
                                            <p class="mt-1 m-0"  style="font-size: 10px;">Biaya Layanan +..%</p>
                                            <p id="total1" class="m-0" style="font-size: 13px;">Rp 0</p>
                                            
                                        </div>
                                        
                                    </label>
                                
                                </div>
                            </div>
                           
                            {{-- <div id="card-isi2" class="card-isi rounded-3 p-3 m-2 d-none" style="height: 80px;width:200px; background-color: #b1b1b1; color:black ;transition: all ease-in 3s">
                                <p class="m-0" style="font-size: 13px;">OVO</p>
                                <p class="mt-1 m-0"  style="font-size: 10px;">Biaya Layanan +..%</p>
                                <p id="total1" class="m-0" style="font-size: 13px;">Rp 0</p>
                                

                               
                            </div>
                           
                            <div id="card-isi3" class="card-isi rounded-3 p-3 m-2 d-none" style="height: 80px;width:200px; background-color: #b1b1b1; color:black ;transition: all ease-in 3s">
                                <p class="m-0" style="font-size: 13px;">GOPAY</p>
                                <p class="mt-1 m-0"  style="font-size: 10px;">Biaya Layanan +..%</p>
                                <p id="total1" class="m-0" style="font-size: 13px;">Rp 0</p>
                                

                               
                            </div> --}}
                          

                        </div>


                        <div id="logo1" class="logo position-relative" style="">
                            <img src="{{ asset('img/pointStore.png') }}" class="position-absolute" alt="" style="height: 20px; right:10px;top:5px">
                        </div>
                    </div>

                    <div class="rounded overflow-hidden " style="">
                        <div id="parent-bayar2" class="parent-bayar d-flex justify-content-between px-2 align-items-center " style=" color:white">
                            <p class="m-0">Virtual Account</p>
                            <div id="arrow2" class="arrow fs-5 " style="transform: rotate(180deg);transition: all ease-in 0.2s;">
                                <i class="bi bi-chevron-up"></i>
                            </div>
                        </div>

                        <div id="isi2" class="isi" style="">

                           
                            <div class="d-flex  w-100 p-2 gap-2 align-items-center">

                                <div class="text-left p-0 rounded-3" style="height:80px;width: 200px;background: #d6d6d6;
                                backdrop-filter: blur(20px); ">
                                    <input type="radio" name="pembayaran" id="mandiri" class="denom payment"  style="width: 100%;height:100%" value="mandiri" onclick="bayar('mandiri')"> 
                                    <label for="mandiri" class="denom-label ">
                                        
                                        
                                        <div class="text-denom card-body text-left d-flex p-2 flex-column" style="height: 70px;color: #7a7a7a">
                                            <p class="m-0" style="font-size: 13px;">MANDIRI</p>
                                            <p class="mt-1 m-0"  style="font-size: 10px;">Biaya Layanan +..%</p>
                                            <p id="total1" class="m-0" style="font-size: 13px;">Rp 0</p>
                                            
                                        </div>
                                        
                                    </label>
                                
                                </div>
                                <div class="text-left p-0 rounded-3" style="height:80px;width: 200px;background: #d6d6d6;
                                backdrop-filter: blur(20px); ">
                                    <input type="radio" name="pembayaran" id="bni" class="denom payment"  style="width: 100%;height:100%" value="bni" onclick="bayar('bni')"> 
                                    <label for="bni" class="denom-label ">
                                        
                                        
                                        <div class="text-denom card-body text-left d-flex p-2 flex-column" style="height: 70px;color: #7a7a7a">
                                            <p class="m-0" style="font-size: 13px;">BNI</p>
                                            <p class="mt-1 m-0"  style="font-size: 10px;">Biaya Layanan +..%</p>
                                            <p id="total1" class="m-0" style="font-size: 13px;">Rp 0</p>
                                            
                                        </div>
                                        
                                    </label>
                                
                                </div>
                                <div class="text-left p-0 rounded-3" style="height:80px;width: 200px;background: #d6d6d6;
                                backdrop-filter: blur(20px); ">
                                    <input type="radio" name="pembayaran" id="bri" class="denom payment"  style="width: 100%;height:100%" value="bri" onclick="bayar('bri')"> 
                                    <label for="bri" class="denom-label ">
                                        
                                        
                                        <div class="text-denom card-body text-left d-flex p-2 flex-column" style="height: 70px;color: #7a7a7a">
                                            <p class="m-0" style="font-size: 13px;">BRI</p>
                                            <p class="mt-1 m-0"  style="font-size: 10px;">Biaya Layanan +..%</p>
                                            <p id="total1" class="m-0" style="font-size: 13px;">Rp 0</p>
                                            
                                        </div>
                                        
                                    </label>
                                
                                </div>
                            </div>
                          

                        </div>


                        <div id="logo2" class="logo position-relative" style="">
                            <img src="{{ asset('img/pointStore.png') }}" class="position-absolute" alt="" style="height: 20px; right:10px;top:5px">
                        </div>
                    </div>

                    





                    
                </div>

            </div>



            <div class="card  mt-4 p-3 container position-relative bg-dark text-white" style="width: auto; height: 10rem; margin-bottom:12rem">
                <h4>Masukkan Nomor Whatsapp ( Opsional )</h4>
                <p>Silakan masukkan email kamu untuk mendapatkan tanda terima untuk pembelian ini</p>
                <label for=""></label>
                <input type="number" class="rounded form-control" style="padding: 10px;background: rgb(214, 214, 214);border:none;" placeholder="No. Whatsapp" name="whatsapp">

                {{-- <a href="" class="btn btn-primary position-absolute "
                    style="width:190px; bottom: 20px; right: 18px;">Beli Sekarang</a> --}}
                {{-- <button type="submit" class="btn btn-primary position-absolute" style="width:190px; bottom: 20px; right: 18px;">Beli Sekarang</button> --}}
            </div>
            <fieldset disabled>
                <input type="text"  class="d-none" id="pembayaran" name="pembayaran">

            </fieldset>
            <nav class="navbar fixed-bottom bg-black text-white">
                <div class="container-fluid position-relative w-50 ">

                    <div class="d-flex flex-column  p-0 justify-content-center ">

                        <p class="m-0 text-white">Total</p>
                        <p class="m-0" id="total2" >-</p>
                       
                        <input type="text" value="p" class="d-none" id="harga" name="harga">
            
                       
                    </div>
                    <button type="submit" id="submit" class="btn btn-primary position-absolute" style="width:190px; bottom: 5px; right: 18px;" >Beli Sekarang</button>

                  
                </div>
              </nav>

            {{-- </form> --}}


        </div>
        <div>
            <script src="https://cdn.lordicon.com/lordicon.js"></script>
            {{-- data-bs-toggle="modal" data-bs-target="#exampleModal" --}}
<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" id="btn" >
    Launch demo modal
  </button>
   --}}
  <!-- Modal -->
  <div class="modal fade " id="exampleModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header justify-content-center flex-column border-none" data-bs-theme="dark" style="border-bottom: 0px">
            <lord-icon
                src="https://cdn.lordicon.com/oqdmuxru.json"
                trigger="in"
                state="morph-check-in-1"
                colors="primary:#30e849"
                style="width:80px;height:80px">
            </lord-icon>

          <h1 class="modal-title mt-2 fs-5" id="exampleModalLabel">Create Order</h1>
          <p>make sure your data and the product is valid and appropriate.</p>
        </div>
        <div class="modal-body" style="">
          <div class="m-1 p-3 rounded" style="background-color: #3e3f44">
            <div class="row">
                <div class="col">
                  ID
                </div>
                <div class="col-md-auto ">
                 :
                </div>
                <div class="col" id="ID-modal">
                 12134124
                </div>
                
            </div>
            <div class="row">
                <div class="col">
                ITEM
                </div>
                <div class="col-md-auto">
                 :
                </div>
                <div class="col" id="DENOM-modal">
                 1 DIAMOND
                </div>
                
            </div>
            <div class="row">
                <div class="col">
                 PRODUCT
                </div>
                <div class="col-md-auto">
                 :
                </div>
                <div class="col" id="PRODUCT-modal">
                 MOBILE LEGEND
                </div>
                
            </div>
            <div class="row">
                <div class="col">
                 PAYMENT
                </div>
                <div class="col-md-auto">
                 :
                </div>
                <div class="col" id="PAYMENT-modal">
                 GOPAY
                </div>
                
            </div>
           

          </div>
           
        </div>
        <div class="row m-3" style="border-top: 0px">
            <div class="col">
                <button type="button" id="close" class="btn btn-outline-warning w-100" data-bs-dismiss="modal">Close</button>
            </div>
            <div class="col">
                <button type="button" id="order" class="btn btn-warning w-100">Order Now</button>

            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<template id="my-template">
    <swal-title style="">Hey!</swal-title>
  </template>

</div>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        
        $(document).ready(function(){
            function validate_id(){
                let idValue = $('input#id').val();
                if(idValue.length == ''){
                    return false;
                
                }else{
                    return true;
                }
            }
            function validate_server()
            {
                let serverValue = $('input#server-id').val();
                if(serverValue.length == ''){
                    return false;
                }else{
                    return true;
                }
            }

            function validateDenom(){
                let valid = false;

               $('input[name="denom"]:checked').each( function(){
                if ($(this).is(":checked")) {
                    valid = true;
                }
               });

               if(!valid){
                return false;

               }else return true;
               
            }
            function validatePayment(){
                let valid = false;

               $('input[name="pembayaran"]:checked').each( function(){
                if ($(this).is(":checked")) {
                    valid = true;
                }
               });

               if(!valid){
                
                return false;
                
               }else return true;
               
            }

            
            
            $("#submit").click(function(){            
                
               if(!validate_id() || !validate_server()){
                    $('html, body').animate({
                        scrollTop: eval($("#sectionId").offset().top-100)
                    }, 100);

                    swal.fire({
                        // title: "Please Choose a Product",
                        icon: 'warning',
                        toast: true,
                        position: 'top-end',
                        text: "Please Input your data",
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(0);
                        }
                    });
                

               }else if(!validateDenom()){
                $('html, body').animate({
                    scrollTop: eval($("#section1").offset().top-100)
                }, 300);
                swal.fire({
                    icon: 'warning',
                    toast: true,
                    position: 'top-end',
                    text: "Please Choose a Product",
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(0);
                    }
     
                });
               
               }else if(!validatePayment()){
                $('html, body').animate({
                    scrollTop: eval($("#payment").offset().top-100)
                }, 300);
                swal.fire({
                    icon: 'warning',
                    toast: true,
                    position: 'top-end',
                    text: "Please Choose a Payment",
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(0);
                    }
     
                });
               }else{
                let productName = $('#product_name').text().toUpperCase();
                let radio = $("input[type='radio']:checked.payment");
                let radio_denom = $("input[type='radio']:checked.variant");

                let id = $('#id').val();
                let server_id = $('#server-id').val();
                let serialNumber = id+server_id;
                let denom = radio_denom.data('item').toUpperCase();
                let payment = radio.val().toUpperCase(); 


                $('#ID-modal').text(serialNumber);
                $('#DENOM-modal').text(denom);
                $('#PAYMENT-modal').text(payment);
                $('#PRODUCT-modal').text(productName);

                $("#exampleModal").modal("show");

               }
                 
                
           
                
            });
            // $('#close').click(function(){
            //     $("#exampleModal").modal("hide");

            // });
            

            $('#parent-bayar').on('click', function(){
                $('#isi').toggleClass('after');
                $('#arrow').toggleClass('rotate-normal');
                $('#logo').toggleClass('close');
                $('#card-isi').toggleClass('card-isi-block');
            })
            $('#parent-bayar1').on('click', function(){
                $('#isi1').toggleClass('after');
                $('#arrow1').toggleClass('rotate-normal');
                $('#logo1').toggleClass('close');
                $('#card-isi1').toggleClass('card-isi-block');
                $('#card-isi2').toggleClass('card-isi-block');
                $('#card-isi3').toggleClass('card-isi-block');
            })
            $('#parent-bayar2').on('click', function(){
                $('#isi2').toggleClass('after');
                $('#arrow2').toggleClass('rotate-normal');
                $('#logo2').toggleClass('close');
                $('#card-isi4').toggleClass('card-isi-block');
                $('#card-isi5').toggleClass('card-isi-block');
                $('#card-isi6').toggleClass('card-isi-block');
            })


            $('#order').on('click', function(){
                
                let radio = $("input[type='radio']:checked.payment");
                let radio_denom = $("input[type='radio']:checked.variant");

                let id = $('#id').val();
                let server_id = $('#server-id').val() ;
                let serialNumber = id+server_id;
                let denom = radio_denom.val();
                let harga = radio_denom.data('harga');
                let productDetail = radio_denom.data('item').toUpperCase();

                let payment = radio.val();
                let productName = $('#product_name').text().toUpperCase();
                


                $('#order').text('loading...');
                $.ajax({
                    url: "{{ route('topup') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    data: {
                        serialNumber : serialNumber,
                        denom : denom,
                        payment : payment,
                        harga: harga,
                        produk : productName,
                        productDetail :productDetail
                        
                    
                    },
                    success: function(res){
                        console.log(res);
                        $("#exampleModal").modal("hide");
                        $('#order').text('Order Now');

                        swal.fire({
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            text: "pesanan berhasil dibuat",
                            timer: 1000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            willClose: () => {
                                // window.location.href = '/cekPesanan/bayar?keyword='+res.order_id;

                                clearInterval(0);
                            }
            
                        });

                    },
                    error: function(err){
                        $("#exampleModal").modal("hide");
                        $('#order').text('Order Now');
                        swal.fire({
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            text: "pesanan gagal dibuat",
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            willClose: () => {

                                clearInterval(0);
                            }
            
                        });
                        console.log(err.statusText);


                    }
                    
                });
            })
        })



        function total(e){
            $('p#total1').text('Rp '+e)
            $('#total2').text('Rp '+e)
            $('#harga').val(e);
        }
        function bayar(text){
            // console.log(text);
            $('#pembayaran').val(text);
        }

    </script>
@endsection
