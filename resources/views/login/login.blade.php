@extends('login.index')

@section('container')

    <div class="row h-100" >
       
        <div class="col-md-3 p-3 text-white" style="margin-left: 10rem; margin-top:10rem">
            @if (session()->has('success'))
                
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
            @endif
    
            @if (session()->has('loginEror'))
                
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginEror') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
            @endif
            <form action="/login" method="POST">
                @csrf
                <h1 class="mb-5 fw-bold text-left">Masuk</h1>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Username" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="password">
                </div>
                <div class="d-flex  justify-content-between">

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                    <div class="mb-3 form-check">
                        <a href="" style="color:orange">Lupa password ?</a>
                    </div>
                </div>

                <button type="submit" class="btn text-white mt-3" style="width: 100%; background-color: rgb(212, 139, 2)">Sign In</button>
            </form>
            <small class="d-block text-center mt-3 ">Belum punya akun ? <a href="/sign-up" style="text-decoration: underline;color:rgb(212, 139, 2)">Daftar</a></small>
        </div>
    </div>

    {{-- <div class="row justify-content-start align-items-center border h-100">
    <div class="col-md-3 mt-5 ms-5 border">
        @if (session()->has('success'))
                
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
        @endif

        @if (session()->has('loginEror'))
            
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginEror') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
        @endif
        <main class="form-registration w-100 m-auto">
            <h1 class="h3 mb-3 fw-normal text-left">Sign In</h1>
            <form action="/login" method="POST">
                @csrf

                <div class="form-floating mt-2">
                    <input type="username" name="username" class="form-control @error('username') is-invalid 
                        
                    @enderror" id="username" placeholder="username" required value="{{ old('username') }}">
                    <label for="username">Username</label>
                    @error('username')
                        
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating mt-2">
                    <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid 
                        
                    @enderror" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
    
                <div class="form-check text-start my-2 ">
                    <input class="form-check-input " name="remember" type="checkbox" id="remember">
                    <label class="form-check-label " for="remember">
                        remember me ?
                    </label>
                   
                </div>
                <button class="btn btn-primary w-100 py-2 mt-2" type="submit">Sign In</button>
             
            </form>
            <small class="d-block text-center mt-3 ">Don't have an account yet ? <a href="/sign-up" style="text-decoration: underline">Sign Up</a></small>
        
        </main>

    </div>
</div> --}}
@endsection
