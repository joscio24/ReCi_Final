@extends('layouts.app')

@section('title') RéCi | Réinitialisation du mot de passe @endSection
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
                    <h5 class="mb-3" style="font-weight: 600;">Réinitialiser le mot de passe</h5>
                    <p class="mb-4">Entrez votre adresse email pour recevoir un code OTP de récupération.</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="row g-3">
                    @csrf

                    <!-- Email Input -->
                    <div class="col-12">
                        <label for="email" class="form-label">Adresse Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre email" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Envoyer le code de réinitialisation</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-primary">Retour à la connexion</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
