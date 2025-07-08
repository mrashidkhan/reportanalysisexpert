@extends('layout.master')

@section('content')
<div class="container mb-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header text-white text-center" style="background-color: #178066;">
                    <h3 class="mb-0">Login</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn text-white btn-lg" style="background-color: #178066;">Login</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="card-footer text-center bg-light">
                    <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Register here</a></p>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
