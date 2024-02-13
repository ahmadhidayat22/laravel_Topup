@extends('layouts.admin')

@section('container-admin')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">

<div class="px-2 m-0  " style="width: 100%;height:100%;overflow-y: scroll">
    <div>

        <h3 class="mt-3 ms-2 fw-bolder">Category</h3>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success mb-3" role="alert">
        {{ session('success') }}
    </div>
@endif
    <hr>
    <div class=" mt-4 mx-1 mb-4 rounded p-3" style="background-color: #24252c;box-shadow: 0px -5px 2px  #676b80">
        <div class="d-flex justify-content-between align-items-baseline" >

            <a href="/admin/category/create" class="d-block" style="width:120px">
                <div class="rounded p-1 mt-2 text-center " style="background-color: rgb(24, 37, 212);width:inherit">Create New</div>
            </a>
            <div class="d-block" style="width: 300px">
                
                <div class="input-group flex-nowrap " data-bs-theme="dark">
                    <span class="input-group-text" id="addon-wrapping"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                  </svg></span>
                  <input type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
            </div>
            

        </div>
        <table class="mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
            </thead>
            <tbody>
                @foreach ($category as $prd => $key)
                    
                <tr>
                    <td>{{ $prd+1 }}</td>
                    <td>{{ $key->category_name }}</td>
                    <td>    
                        <a href="/admin/category/{{ $key->slug }}/edit" class="badge bg-warning text-center "><i
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

       

    </div>


</div>


@endsection