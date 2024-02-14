@extends('layouts.admin')

@section('container-admin')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    <div class="contener px-2 m-0 " style="width: 100%;height:100%;overflow-y: scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mt-3 ms-2 fw-bolder">Product</h3>
            <div class="d-block" style="width: 300px">

                <div class="input-group flex-nowrap " data-bs-theme="dark">
                    <span class="input-group-text" id="addon-wrapping"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-search"
                            viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg></span>
                    <input type="text" class="form-control" placeholder="Search" aria-label="Username"
                        aria-describedby="addon-wrapping">
                </div>
            </div>
        </div>
        <hr>
        <div class=" mt-4 mx-1 rounded " style="margin-bottom:8em;background-color: #24252c;">


            <nav>
                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                    @foreach ($category as $ct)
                        <button class="tabs-nav nav-link " id="nav-{{ $ct->id }}-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-{{ $ct->id }}" type="button" role="tab"
                            aria-controls="nav-{{ $ct->id }}" aria-selected="true">{{ $ct->category_name }}</button>

            
                    @endforeach
                </div>

            </nav>
            <div class="px-3 position-relative">
                <div class=" position-relative" style="z-index: 2;background-color: #24252c;">

                    <div class="tab-content" id="nav-tabContent">

                        @foreach ($category as $ct)
                            <div class="tab-pane fade my-3 " id="nav-{{ $ct->id }}" role="tabpanel"
                                aria-labelledby="nav-{{ $ct->id }}-tab" tabindex="0">
                                @foreach ($product as $pt)
                                    @if ($pt->fk_category == $ct->id)
                                        <button type="button" class="product-btn btn py-1 my-1 px-2 mx-1"
                                            style="color:#aeb913; background-color: #35384bc0; border: 1px solid #aeb913"
                                            data-toggle="tab2" data-id="{{ $pt->id }}">{{ $pt->nama }} </button>
                                    @endif
                                @endforeach
                            </div>

                            
                        @endforeach

                        <hr class="m-1">
                    </div>


                    <div class="d-flex justify-content-between align-items-baseline mb-3">

                        <a href="/admin/product/create" class="d-block" style="">
                            <div class="rounded px-2 mt-2 text-center py-1 " style="background-color: #727ae4;font-weight:400;font-size:14px"><i class="bi bi-plus" style="font-size:20px"></i>Tambah Product</div>
                        </a>
                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Launch demo modal
                          </button>
                           --}}
                            
     
                 

                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success mb-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                  
                </div>

                <div class="table-content-product "></div>

            </div>
            
            <hr>

            <div class="pb-4 px-3">
                <table>
                    <thead>
                        <tr>
                            <th>Sku Code</th>
                            <th>Product Name</th>
                            <th>Product varian</th>
                            <th>Seller Price</th>
                            <th>Buyer Price (Rp)</th>
                            <th>Seller Status</th>
                            <th>Buyer Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-product">
                      
                            @if (count($product_detail) == 0)
                                
                            <tr class="">
                                <td colspan="8">
                                  <div class=" d-flex flex-column align-items-center justify-content-center" style="height: 40px;">
                                      <p class="m-0">No data</p>
                                  </div>
                  
                                </td>
                               
                              </tr>
                            
                            @endif
                        
                       
                        {{-- <tr>
                            <td><input type="text" value="000"class="rounded text-center text-white" style="max-width: 80px;background-color: #3a3a3e;border:1px solid white"></td>
                            <td>mobile legend</td>
                            <td>2 Diamond</td>
                            <td>Rp 3.000</td>
                            <td><input type="text" value="3.500"class="rounded text-center text-white" style="max-width: 80px;background-color: #3a3a3e;border:1px solid white"></td>
                            <td>On</td>
                            <td>Off</td>

                            <td><button class="btn btn-primary" style="padding: 2px 4px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                              </svg></button>
                              <button class="btn btn-danger" style="padding: 2px 4px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                              </svg></button>
                            </td>
                        </tr> --}}

                    </tbody>
                </table>
            </div>
        </div>

   
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header text-black">
              <h1 class="modal-title fs-5 " id="exampleModalLabel">Add Variant</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-black">
              <form action="/admin/productDetails" method="POST">
                @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Product denom</label>
                        <input type="text" class="form-control @error('product_price') is-invalid @enderror" id="title" placeholder="Nama Produk" name="product_denom" autofocus value="{{ old('nama') }}">
                       
                    </div>
                
                <div class="mb-3">
                    <label for="provider" class="form-label">Product Type</label>
                    <input type="text" class="form-control @error('product_type') is-invalid @enderror" id="provider" placeholder="Ex: Umum, Khusus, berlangganan" name="product_type">
                    
        
                </div>
                <div class="mb-3">
                    <label for="provider" class="form-label">Product Price (Rp)</label>
                    <input type="text" class="form-control @error('product_buyer_price') is-invalid @enderror" id="provider" placeholder="Harga (Rp)" name="product_buyer_price" style="" type-currency="IDR">
                    
        
                </div>

                <input type="text " class="d-none" id="product_slug" value="" name="slug">
                <button type="submit" class="btn btn-primary">Add Product</button>

              </form>
            </div>
          </div>
        </div>
      </div>   

    </div>
   
    
    <script>
        $(document).ready(function() {
            $('.tabs-nav:first-child').addClass('active');
            $('.tab-pane:first-child').addClass('active show');


            $('.product-btn').on('click' , function () {
                $('.product-btn').removeClass('product-btn-focus');
                $(this).addClass('product-btn-focus');
            })

            $('.tab-pane button').on('click', function() {
                $('.table-content-product').empty();
                $('#table-product').empty();
                let data_id = $(this).attr('data-id');
                // let title = 'title';
                // let provider = 'provider';
                // let img ='https://images.unsplash.com/photo-1477666250292-1419fac4c25c?auto=format&amp;fit=crop&amp;w=667&amp;q=80&amp;ixid=dW5zcGxhc2guY29tOzs7Ozs%3D'
                let product = <?php echo $product; ?>;
                let product_details = <?php echo $product_detail; ?>;

                if( product_details.length <= 0){
                    $('#table-product').append('<tr><td colspan="8"><div class=" d-flex flex-column align-items-center justify-content-center" style="height: 40px;"><p class="m-0">No data</p></div></td></tr>');
                

                }
                
                jQuery.each(product, function(i, val) {
                    // console.log(val.nama );
                    if (val.id == data_id) {
                        let slug = val.slug;
                                
                        console.log(slug);
                        $('#product_slug').val(slug);

                        $('.table-content-product').append('<div class="d-flex gap-2 justify-content-between"><div class="d-flex gap-3"><div class="overflow-hidden rounded"><img src="/storage/'+val.picture+'" style=" max-width: 150px;" /></div><div><h3>'+val.nama +'</h3><p>Desc :'+val.deskripsi+'</p><p>Provider : '+val.provider+'</p></div></div><div class=" align-items-start justify-content-end d-flex" style="gap: 10px;"><a href="#"class="d-block "><div class="rounded px-2 text-center d-flex align-items-center "style="background-color: #75adc7;width:fit-content;gap:5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"fill="currentColor"class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" /><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" /></svg><span>Edit</span>  </div></a><button class="btn btn-danger text-center d-flex align-items-center px-2 py-0"style="gap: 10px;"type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" /></svg><span>Delete</span> </button><button class="btn btn-primary py-0 px-2 text-center position-absolute bottom-0"  data-bs-toggle="modal" data-bs-target="#exampleModal" style="gap: 10px;font-size:15px;"type="button"><i class="bi bi-plus" style="font-size:20px"></i><span>Tambah variant</span></button></div></div>');

                        jQuery.each(product_details, function(i, val2) {
                            
                            if (val2.id_product == val.id) {

                                // console.log(val2);
                                let product_name = val2.product_name;
                                let variant = val2.product_denom;
                                let sku_code = val2.product_sku;
                                let seller_price = val2.product_seller_price;
                                let buyer_price = val2.product_buyer_price;
                                let seller_status = val2.product_status_seller;
                                let buyer_status = val2.product_status_buyer;
                                

                                // $('.contener').append('  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header text-black"><h1 class="modal-title fs-5 " id="exampleModalLabel">Add Variant</h1><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body text-black"><form action="/admin/productDetails" method="POST">@csrf<div class="mb-3"><label for="title" class="form-label">Product denom</label><input type="text" class="form-control " id="title" placeholder="Nama Produk" name="product_price" autofocus value=""></div><div class="mb-3"><label for="provider" class="form-label">Product Type</label><input type="text" class="form-control " id="provider" placeholder="Ex: Umum, Khusus, berlangganan" name="product_type"></div><div class="mb-3"><label for="provider" class="form-label">Product Price (Rp)</label><input type="text" class="form-control " id="provider" placeholder="Harga (Rp)" name="product_buyer_price" style="" type-currency="IDR"></div><button type="submit" class="btn btn-primary">Add Product</button></form></div></div></div></div> </div>');
                                
                                $('#table-product').append(
                                    '<tr><td><input type="text" value="' + sku_code +
                                    '"class="rounded text-center text-white" style="max-width: 80px;background-color: #3a3a3e;border:1px solid white"></td><td>' +
                                    product_name + '</td><td>' + variant +
                                    '</td><td>Rp ' + seller_price +
                                    '</td><td><input type="text" value="' +
                                    buyer_price +
                                    '"class="rounded text-center text-white" style="max-width: 80px;background-color: #3a3a3e;border:1px solid white"></td><td>' +
                                    seller_status + '</td><td>' + buyer_status +
                                    '</td><td><button class="btn btn-primary" style="padding: 2px 4px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16"><path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/><path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/></svg></button><button class="btn btn-danger" style="padding: 2px 4px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/><path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/></svg></button></td></tr>'
                                    );

                                
                            }
                        })
                    }

                });
                // console.log($(this).attr("data-id"));
            })



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
                }
            });
        });
        });
    </script>
@endsection
