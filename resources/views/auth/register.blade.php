@extends('layouts.blank')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <h1 class="text-center my-5">Create Account</h1>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <label for="floatingInput">{{ __('Name') }}</label>
                                </div>
                            </div>

                            @error('name')
                                <div class="col-12">
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                            @enderror
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <label for="floatingInput">{{ __('Email Address') }}</label>
                                </div>
                            </div>

                            @error('email')
                                <div class="col-12">
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <label for="floatingInput">{{ __('Password') }}</label>
                                </div>
                            </div>
                            
                            @error('password')
                                <div class="col-12">
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                            @enderror
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password">
                                    <label for="floatingInput">{{ __('Confirm Password') }}</label>
                                </div>
                            </div>
                            
                            @error('password_confirmation')
                                <div class="col-12">
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Create') }}
                            </button>
                            <a class="btn btn-link ms-2" href="{{ route('login') }}">
                                {{ __('Login to Account') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
