@extends('layouts.app')

@section('content')

<div class="register-page login-page bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="container p-4">
        <div class="row rounded overflow-hidden">
            <!-- Left Section with Images -->
            <div class="col-md-6 p-0">
                <div class="d-flex justify-content-center">
                    <div class="image-section its"></div>
                    <div class="image-section"></div>
                    <div class="image-section"></div>
                </div>
            </div>

            <!-- Right Section with Form -->
            <div class="col-md-5 p-5">
                <div class="text-center">
                    <img id="logo-img" src="/images/logo_reci_noir.png" alt="Logo" class="mb-3" style="width: 100px;" />
                    <h5 class="mb-3" style="font-weight: 600;">Créer un compte</h5>
                </div>
                <form method="POST" action="{{ route('register') }}" class="row g-3">
                    @csrf

                    <!-- Name Input -->
                    <div class="col-12">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" required>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div class="col-12">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Votre email" required>
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="col-12">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Votre mot de passe" required>
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="col-12">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmez votre mot de passe" required>
                        @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Register Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p>Vous avez déjà un compte ? <a href="{{ route('login') }}" class="text-primary">Se connecter</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
