<div>
    <!-- Header -->

    <style>
        .outline-border {
            border: 1px solid #fff;
            border-radius: 10px;
            padding: 10px;
        }
    </style>

    <nav class="nav-bar">
        <div class="nav-content w-100 d-flex justify-content-between align-items-center p-2">
            <!-- Logo -->
            <a href="/accueil">
                <div class="logo">
                    <img id="logo-img" src="/images/logo_reci_blanc.png" alt="Logo" />
                </div>
            </a>

            <!-- Mobile Menu Toggle Button -->
            <button class="menu-toggle-btn d-md-none" id="mobileMenuToggle" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Menu -->
            <ul class="menu d-none d-md-flex">
                <li><a href="/debats" class="menu-link">Débats</a></li>
                <li><a href="#si" class="menu-link active text-white" style="font-size: medium; font-weight: 900;"
                        data-bs-toggle="modal" data-bs-target="#contributionModal">Lancer un débat</a></li>

                @auth
                    <!-- Show only if user is authenticated -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle menu-link" data-bs-toggle="dropdown" role="button"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <!-- <li><a class="dropdown-item" href="{{ route('profile') }}">Mon profil</a></li> -->
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Se déconnecter</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a class=" menu-link -border" href="{{ route('register') }}">S'inscrire</a></li>
                    <li><a class="outline-border menu-link " href="{{ route('login') }}">Se connecter</a></li>

                @endauth
            </ul>
        </div>

        <!-- Mobile Menu -->
        <ul class="mobile-menu d-md-none" id="mobileMenu">
            <li><a href="/debats" class="menu-link">Débats</a></li>
            <li><a href="#si" class="menu-link active" data-bs-toggle="modal"
                    data-bs-target="#contributionModal">Soumettre une idée</a></li>

            @auth

                <!-- <li><a href="{{ route('profile') }}" class="menu-link">Mon profil</a></li> -->
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="menu-link btn btn-secondary ">Se déconnecter</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="outline-border menu-link">Se connecter</a></li>
                <li><a href="{{ route('register') }}" class="outline-border menu-link">S'inscrire</a></li>
            @endauth
        </ul>
    </nav>
</div>
<script>
    document.getElementById('mobileMenuToggle').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('active');
    });
</script>
<!--  -->
