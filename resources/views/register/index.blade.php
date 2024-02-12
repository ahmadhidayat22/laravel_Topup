@extends('login.index')

@section("container")

    <div class="row h-100" >
       
        <div class="col-md-3 p-3 text-white" style="margin-left: 10rem; margin-top:10rem">
            {{-- @if (session()->has('success'))
                
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
            
            @endif --}}
            <form action="/sign-up" method="POST">
                @csrf
                <h1 class="mb-5 fw-bold text-left">Daftar</h1>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your name" id="name" name="name" required value="{{ old('name') }}">
                    @error('name')
                        
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" id="username" name="username" required value="{{ old('username') }}">
                    @error('username')
                        
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email" required value="{{ old('email') }}">
                    @error('email')
                        
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror


                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="password" required value="{{ old('password') }}">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                        
                    @enderror
                </div>
               
                <div class="mb-3 form-check">
                    <label for="policy" class="form-check-label">Saya setuju dengan kebijakan privasi</label>
                    <input type="checkbox" class="form-check-input @error('policy') is-invalid @enderror " id="policy" name="policy">
                    @error('policy')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                        
                    @enderror
                </div>
               
               
               
                {{-- <div class="d-flex  justify-content-between">

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <div class="mb-3 form-check">
                        <a href="" style="color:orange">Lupa password ?</a>
                    </div>
                </div> --}}

                <button type="submit" class="btn text-white mt-3" style="width: 100%; background-color: rgb(212, 139, 2)">Sign In</button>
            </form>
            <small class="d-block text-center mt-3 ">Sudah punya akun ? <a href="/login" style="text-decoration: underline;color:rgb(212, 139, 2)">Masuk</a></small>
        </div>
    </div>



{{-- <div class="row justify-content-center">
    <div class="col-lg-4 mt-5">

        <main class="form-registration w-100 m-auto">
            <h1 class="h3 mb-3 fw-normal text-center text-white">Sign Up</h1>
            <form action="/sign-up" method="POST">
                @csrf
    
                <div class="form-floating mt-2">
                    <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid 
                    @enderror" id="name" placeholder="Your name" required value="{{ old('name') }}">
                    <label for="name">Full Name</label>
                    @error('name')
                        
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
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
                    <input type="email" name="email" class="form-control @error('email') is-invalid 
                        
                    @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}"> 
                    <label for="email">Email address</label>
                    @error('email')
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
    
                <div class="form-check text-start my-2 text-white">
                    <input class="form-check-input @error('policy') is-invalid 
                    @enderror" name="policy" type="checkbox" id="policy" required>
                    <label class="form-check-label" for="policy">
                        I Agree to Privacy Policy
                    </label>
                    @error('policy')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                        
                    @enderror
                </div>
                <button class="btn btn-primary w-100 py-2 mt-2" type="submit">Register</button>
             
            </form>
            <small class="d-block text-center mt-3 text-white">Already have an account ? <a href="/login" style="text-decoration: underline">Sign In</a></small>
        
        </main>

    </div>
</div> --}}

    
@endsection