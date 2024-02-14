@extends('layouts.admin')

@section('container-admin')

<div class="px-2 m-0  " style="width: 100%;height:100%;overflow-y: scroll">
    <div>

        <h3 class="mt-3 ms-2 fw-bolder">New Category</h3>
    </div>
    <hr>
    <div class=" mt-4 mx-1 mb-4 rounded p-3" style="background-color: #24252c;box-shadow: 0px -5px 2px  #676b80; ">
       <div>
        <form action="/admin/category/" method="post" >
            @csrf
            <div class="mb-3">
                <label for="category_name" class="form-label">Category</label>
                <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" placeholder="Nama Category" name="category_name" autofocus value="{{ old('category_name') }}">
                @error('category_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            
    
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
    </div>

</div>


@endsection