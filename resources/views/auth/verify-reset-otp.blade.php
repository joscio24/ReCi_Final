@extends('layouts.app')

@section('title') RéCi | Vérification OTP @endSection
@section('content')

<div class="login-page bg-light overflow-hidden">
    <div class="container p-4">

        <div class="row rounded overflow-hidden">
            <!-- Left Section with Images -->
            <div class="col-md-6 p-2 i-holders">
                <div class="d-flex justify-content-center">
                    <div class="image-section its"></div>
                    <div class="image-section"></div>
                    <div class="image-section"></div>
                </div>
            </div>

            <!-- Right Section with Form -->
            <div class="col-md-5 p-5">
                <div class="text-center">
                    <a href="https://monreci.bj">
                        <img id="logo-img" src="/images/logo_reci_noir.png" alt="Logo" class="mb-3" style="width: 120px;" />
                    </a>
                    <h5 class="mb-3" style="font-weight: 600;">Vérifie ton code</h5>
                    <p class="mb-4">Un code OTP a été envoyé à : <strong>{{ $email }}</strong></p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('password.otp.verify') }}" class="row g-3">
                    @csrf

                    <!-- OTP Input -->
                    <div class="col-12">
                        <label for="otp" class="form-label">Code OTP</label>
                        <input type="text" id="otp" name="otp" class="form-control" placeholder="Entrez le code OTP" maxlength="6" required>
                        @error('otp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Vérifier le code</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <button type="submit" class="btn btn-link text-primary p-0">Renvoyer le code</button>
                    </form>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-primary">Retour à la connexion</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
