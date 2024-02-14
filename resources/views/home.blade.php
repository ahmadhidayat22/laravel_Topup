@extends('layouts.main')

@section('container')
    <div class="container" >
        {{-- style="width: 70%" --}}

        <div class="overflow-hidden position-relative" style=" ;width:100%; ">
           
            <div id="carouselExampleInterval" class="carousel slide position-relative rounded-5" style="height: 100%; width:100% ;"
                data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  </div>
                  
                <div class="carousel-inner overflow-hidden rounded-5">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="https://source.unsplash.com/700x300/?game" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="https://source.unsplash.com/700x300/?game" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://source.unsplash.com/700x300/?game" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <h2 class="mt-5 text-white">Populer</h2>
        <div class="container p-2 ">
            <div class="">
                <ul class="d-flex gap-3 p-0">
                   
                @foreach ($category as $ct )
                    
                    <li id='category' data-kategori="{{ $ct->category_name}}" class="kategory btn  btn-secondary rounded-5 px-3">{{ $ct->category_name }}</li>
                 
                @endforeach
            </ul>
            
            </div>

        </div>
        <div class="container mt-3 text-center">
            <div class="parent_product  row ">
        
                @foreach ($product as $gm )
      
                <div class="list_product  col-4 col-sm-3 col-md-2 mb-3">
                    
                    <a href="/product/{{ $gm->slug }}">

                        <div class="kartu ">
                            <img src="/storage/{{ $gm->picture }}"/>
                            <div class="info text-left" id="">
                              <h4 class="m-0">{{ $gm->nama }}</h4>
                              <p class="m-0" style="color: rgba(211, 211, 211, 0.767)">{{ $gm->provider ?? 'undefined' }}</p>
                            </div>
                        </div>
                   
                    </a>


                </div>

                @endforeach
              
            </div>
            
            {{-- <div class="card" style="width: 15rem; height: 19rem;">
                      

                <img src="https://source.unsplash.com/700x400/?game" class="card-img" alt="...">
            
                <div class="card-img-overlay bg-red" style="">
                    <p class="card-text">{{ $gm->nama }}</p>
                </div>

            </div> --}}

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.kategory').on('click', function(){
                // $(this).addClass('bg-dark');
                $(this).addClass('bg-dark');
                

                let kategori = $(this).data('kategori');
              
                $.ajax({
                    url: "{{ route('get_produk') }}",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        parameter: kategori
                    },
                success: function(response) {
                    // ubah isi list produk
                    $('.list_product').remove();
                    
                    for(let i= 0; i < response.length; i++) {
                    // console.log(response[i]);
                    // $('.parent_product').append('<div class="list_product col mb-3"><a href="/product/'+response[i].slug+'"><div class="kartu"><img src="https://images.unsplash.com/photo-1477666250292-1419fac4c25c?auto=format&amp;fit=crop&amp;w=667&amp;q=80&amp;ixid=dW5zcGxhc2guY29tOzs7Ozs%3D"/><div class="info text-left" id=""><h4 class="m-0">'+response[i].nama+'</h4><p class="m-0" style="color: rgba(211, 211, 211, 0.767)">moonton</p></div></div></a>')
                    $('.parent_product').append('<div class="list_product  col-4 col-sm-3 col-md-2 mb-3"><a href="/product/'+response[i].slug +'"><div class="kartu "><img src="https://images.unsplash.com/photo-1477666250292-1419fac4c25c?auto=format&amp;fit=crop&amp;w=667&amp;q=80&amp;ixid=dW5zcGxhc2guY29tOzs7Ozs%3D"/><div class="info text-left" id=""><h4 class="m-0">'+response[i].nama+'</h4><p class="m-0" style="color: rgba(211, 211, 211, 0.767)">'+response[i].provider+'</p></div></div></a></div>')
                        
                    }

                    // $('.list-product').html(response.produk);
                    // console.log(response);
                }
              
                });

            })
           
            
        })
    </script>
@endsection
