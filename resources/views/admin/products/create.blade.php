@extends('layouts.admin')

@section('container-admin')

<div class="px-2 m-0  " style="width: 100%;height:100%;overflow-y: scroll">
    <div>

        <h3 class="mt-3 ms-2 fw-bolder">New Product</h3>
    </div>
    <hr>
    <div class=" mt-4 mx-1 mb-4 rounded p-3" style="background-color: #24252c;box-shadow: 0px -5px 2px  #676b80; ">
       <div>
        <form action="/admin/product/" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="title" placeholder="Nama Produk" name="nama" autofocus value="{{ old('nama') }}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-3  ">
                <label for="slug" class="form-label">slug</label>
                <input type="text" class="form-control  @error('slug') is-invalid @enderror" style="background-color: #b4b4b4;border:none" id="slug" placeholder="nama-produk" name="slug" value="{{ old('slug') }}"  readonly > 
                @error('slug')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="fk_category" class="form-label">Category</label>
                <select class="form-select @error('fk_category') is-invalid @enderror" id="fk_category" aria-label="Default select example" name="fk_category" >
                    <option value="" selected>- Choose Category -</option>
                    @if(count($category) < 1)
                            
     
                    @endif
                @foreach ($category as $count => $ct )
                    @if (old('fk_category') === $ct->category_name)
                        <option value="{{ $ct->id }}" selected>{{ $ct->category_name }}</option>
                    @else
                        <option value="{{ $ct->id  }}">{{ $ct->category_name }}</option>

                    @endif
                
                @endforeach

                </select>
                @error('category')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
        </div>

       
        <div class="mb-3">
            <label for="provider" class="form-label">Provider</label>
            <input type="text" class="form-control @error('provider') is-invalid @enderror" id="provider" placeholder="Ex: Telkomsel,Tencent,Moonton" name="provider">
            
            @error('provider')
                <p class="text-danger">{{ $message }}</p>
            @enderror

        </div>

        <div class="mb-3">
            <label class="form-label" for="picture">Upload gambar</label>
          
            <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture" >
            @error('picture')
                <p class="text-danger">{{ $message }}</p>
            @enderror

        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            @error('deskripsi')
                <p class="text-danger m-0">{{ $message }}</p>
            @enderror
            <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
            <trix-editor input="deskripsi"></trix-editor>
        </div>
        
        <button type="submit" class="btn btn-primary">Add Product</button>
        <a href="/admin/product"><button class="btn btn-danger" type="button">Cancel</button></a>
    </form>
    </div>
       

    </div>


</div>


<script>
        const title = document.querySelector("#title");
        const slug = document.querySelector("#slug");

        title.addEventListener("change", function() {
          fetch('/admin/product/create/checkslug?title=' + title.value)
          .then(response => response.json())
          .then(data => slug.value = data.slug);
       
        });



    document.addEventListener('trix-file-editor', function(e){
        e.preventDefault;
    })
</script>

@endsection