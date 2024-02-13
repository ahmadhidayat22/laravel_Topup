@extends('layouts.admin')

@section('container-admin')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    <div class="px-2 m-0  " style="width: 100%;height:100%;overflow-y: scroll">
        <div>

            <h3 class="mt-3 ms-2 fw-bolder">Product</h3>
        </div>
        <hr>
        <div class=" mt-4 mx-1 mb-4 rounded " style="background-color: #24252c;">


            <nav>
                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                    @foreach ($category as $ct)
                        <button class="nav-link " id="nav-{{ $ct->id }}-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-{{ $ct->id }}" type="button" role="tab"
                            aria-controls="nav-{{ $ct->id }}" aria-selected="true">{{ $ct->category_name }}</button>

                        {{-- <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Profile</button>

            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
            <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false" disabled>Disabled</button> --}}
                    @endforeach
                </div>

            </nav>
            <div class="px-3 position-relative">
                <div class=" position-relative" style="z-index: 2;background-color: #24252c;">

                    <div class="tab-content" id="nav-tabContent">

                        @foreach ($category as $ct)
                            <div class="tab-pane fade my-3" id="nav-{{ $ct->id }}" role="tabpanel"
                                aria-labelledby="nav-{{ $ct->id }}-tab" tabindex="0">
                                @foreach ($product as $pt)
                                    @if ($pt->fk_category == $ct->id)
                                        <button type="button" class="btn py-1 px-2"
                                            style="color:#aeb913; background-color: #35384bc0; border: 1px solid #aeb913"
                                            data-toggle="tab2" data-id="{{ $pt->id }}">{{ $pt->nama }} </button>
                                    @endif
                                @endforeach
                            </div>

                            {{-- <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">2</div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">3</div>
                    <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">..4.</div> --}}
                        @endforeach

                        <hr class="m-1">
                    </div>


                    <div class="d-flex justify-content-between align-items-baseline mb-3">

                        <a href="/admin/product/create" class="d-block" style="">
                            <div class="rounded py-1 px-2 mt-2 text-center " style="background-color: #4c56e7;">Tambah
                                Product</div>
                        </a>
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
                    @if (session()->has('success'))
                        <div class="alert alert-success mb-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    {{-- <table class="mt-4">
                    <thead>
                        <tr>
                            
                            <th>No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Desc</th>
                            <th>Dev</th>
                            <th>Picture</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $prd => $key)
                            
                        <tr>
                            <td>{{ $prd+1 }}</td>
                            <td>{{ $key->nama }}</td>
                            <td>{{ $key->category ?? '-'}}</td>
                            <td>{!! $key->deskripsi ?? '-'!!}</td>
                            <td>{{ $key->developer ?? '-'}}</td>
                            <td>{{ $key->gambar }}</td>
                            <td>
                                <a href="/admin/product/{{ $key->slug }}" class="badge bg-info text-center "><i
                                    class="bi bi-eye fs-6"></i></a>
                            <a href="/admin/product/{{ $key->slug }}/edit" class="badge bg-warning text-center "><i
                                    class="bi bi-pencil fs-6"></i></a>

                            <form method="post" action="/admin/product/{{ $key->slug }}" class="d-inline">
                                @method('delete')
                                @csrf

                                <button class="badge bg-danger border-0 " onclick="return confirm('Are you sure ?')"><i
                                        class="bi bi-trash3 fs-6"></i></button>

                            </form>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                --}}
                </div>

                <div class="table-content-product ">

                    {{-- <div class="row ">

                        <div class="col-2 ">

                            <img src="https://images.unsplash.com/photo-1477666250292-1419fac4c25c?auto=format&amp;fit=crop&amp;w=667&amp;q=80&amp;ixid=dW5zcGxhc2guY29tOzs7Ozs%3D"
                                style="aspect-ratio: 1/1; max-width: 200px;" />
                        </div>
                        <div class="col-6 ">
                            <h3>Title</h3>
                            <p>Lorem, ipsum dolor</p>
                            <p>devv</p>
                        </div>
                        <div class="col  align-items-start justify-content-end d-flex" style="gap: 10px;">
                            <a href="#" class="d-block ">
                                <div class="rounded px-2 text-center d-flex align-items-center "
                                    style="background-color: #75adc7;width:fit-content;gap:5px;"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                    <span>Edit</span>
                                </div>
                            </a>
                            <button class="btn btn-danger text-center d-flex align-items-center px-2 py-0"
                                style="gap: 10px;" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                </svg>
                                <span>Delete</span> </button>

                        </div>
                    </div> --}}


                </div>
                


            </div>

            <hr>

            <div>
                <table>
                    <thead>
                        <tr>
                            <th>hellp</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>


    </div>
    
    <script>
        $(document).ready(function() {
            $('#nav-1-tab').addClass('active');
            $('#nav-1').addClass('active show');


            $('.tab-pane button').on('click', function() {
                $('.table-content-product').empty();
                let data_id = $(this).attr('data-id');
                // let title = 'title';
                // let provider = 'provider';
                // let img = 'https://images.unsplash.com/photo-1477666250292-1419fac4c25c?auto=format&amp;fit=crop&amp;w=667&amp;q=80&amp;ixid=dW5zcGxhc2guY29tOzs7Ozs%3D'
                let product = <?php echo $product?>;
                let product_details = <?php echo $product_detail ?>;
                console.log(product_details);

                jQuery.each(product, function(i,val){
                    // console.log(val.nama );
                    if(val.id == data_id){

                        
                        
                        $('.table-content-product').append('<div class="row "><div class="col-2 "><img src="'+img+'"style="aspect-ratio: 1/1; max-width: 200px;" /></div><div class="col-6 "><h3>'+val.nama +'</h3><p>'+val.gambar+'</p><p>'+val.provider+'</p></div><div class="col  align-items-start justify-content-end d-flex" style="gap: 10px;"><a href="#" class="d-block "><div class="rounded px-2 text-center d-flex align-items-center "style="background-color: #75adc7;width:fit-content;gap:5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" /></svg><span>Edit</span> </div></a><button class="btn btn-danger text-center d-flex align-items-center px-2 py-0"style="gap: 10px;" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" /></svg><span>Delete</span> </button></div></div>');
                    }
                        
                });
                // console.log($(this).attr("data-id"));
            })

        });
    </script>
@endsection
