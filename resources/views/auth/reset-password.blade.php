@extends('layouts.app')

@section('title') RéCi | Nouveau mot de passe @endSection
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
                    <h5 class="mb-3" style="font-weight: 600;">Nouveau mot de passe</h5>
                    <p class="mb-4">Définissez un nouveau mot de passe pour votre compte.</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('password.update') }}" class="row g-3">
                    @csrf

                    <!-- Hidden Email -->
                    <input type="hidden" name="email" value="{{ $email }}">

                    <!-- Password -->
                    <div class="col-12">
                        <label for="password" class="form-label">Nouveau mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Entrer le nouveau mot de passe" required>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-12">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmez le mot de passe" required>
                    </div>

                    <!-- Submit -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Réinitialiser le mot de passe</button>
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
