@extends('layouts.blank')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <h1 class="text-center my-5">Login</h1>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <label for="floatingInput">{{ __('Email Address') }}</label>
                                </div>
                            </div>

                            @error('email')
                                <div class="col">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                            @enderror
                        </div>

                        
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <label for="floatingInput">{{ __('Password') }}</label>
                                </div>
                            </div>
                            
                            @error('password')
                                <div class="col">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            <div class="form-check ms-4">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <hr>

                        @if (Route::has('password.request'))
                            <div class="row text-center">
                                <div class="col">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
