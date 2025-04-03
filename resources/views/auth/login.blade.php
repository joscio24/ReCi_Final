@extends('layouts.app')

@section('content')


<div class="login-page bg-light  overflow-hidden">
    <div class="container p-4">

        <div class="row  rounded overflow-hidden">
            <!-- Left Section with Images -->
            <div class="col-md-6 p-2 i-holders " >
                <div class="d-flex justify-content-center">
                    <div class="image-section its" ></div>
                    <div class="image-section" ></div>
                    <div class="image-section" ></div>
                </div>
            </div>
            <!-- Right Section with Form -->
            <div class="col-md-5  p-5">
                <div class="text-cente">
                    <img id="logo-img" src="/images/logo_reci_noir.png" alt="Logo" class="mb-3" style="width: 120px;" />
                    <h5 class="mb-3" style="font-weight: 600;">Ravi de te revoir</h5>
                </div>
                <form method="POST" action="{{ route('login') }}" class="row g-3">
                    @csrf
                    <!-- Email Input -->
                    <div class="col-12">
                        <label for="email" class="form-label">Utilisateur</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email ou numéro de téléphone" required>
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="col-12">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me">
                            <label class="form-check-label" for="remember-me">Se souvenir de moi</label>
                        </div>
                        <a href="#" class="text-primary">Mot de passe oublié ?</a>
                    </div>

                    <!-- Login Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                    </div>

                    <!-- Google Sign-In Button -->
                    <div class="col-12">
                        <button type="button" class="btn btn-outline-dark w-100">
                            <i class="bi bi-google"></i> Se connecter avec Google
                        </button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p>Vous n'avez pas encore de compte ? <a href="{{ route('register') }}" class="text-primary">Inscrivez-vous maintenant</a></p>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
