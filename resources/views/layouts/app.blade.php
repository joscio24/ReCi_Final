<!DOCTYPE html>
<html lang="fr">
<?php
header('Content-Type: text/html; charset=UTF-8');

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(session('token'))
    <meta name="bearer-token" content="{{ session('token') }}">
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/bootstrap/dist/mobile.css">
    <link rel="stylesheet" href="/bootstrap/dist/main.css">
    <link rel="stylesheet" href="/bootstrap/dist/icofont.css">
    <link rel="stylesheet" href="/bootstrap/dist/animate.css">
    <link rel="stylesheet" href="/bootstrap/fontawesome-free-6.6.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@4.6.2/dist/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@4.6.2/dist/index.min.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/toastr.min.css"> -->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/toastr.min.css">



    <title>@yield('title')</title>
</head>

<body>
    <!-- <div class="content-section">
        @if (session('token'))
        <p>Your Token: {{ session('token') }}</p>
        @else
        <p>NO token found</p>
        @endif


    </div> -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
            showToast("{{ session('success') }}", 'success');
            @endif

            @if($errors -> any())
            @foreach($errors -> all() as $error)
            showToast("{{ $error }}", 'error');
            @endforeach
            @endif
        });
    </script>


    @yield('content')



    <div class="modal fade" id="contributionModal" tabindex="-1" aria-labelledby="contributionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contributionModalLabel">Soumettre une idéé de débat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('debats.store') }}" enctype="multipart/form-data">

                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre de l'idée *</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image mise en avant</label>
                            <input type="file" id="image" name="image" class="form-control" accept=".jpg,.jpeg,.png">
                            <small class="form-text text-muted">Types de fichiers autorisés : jpg, jpeg, png. Taille maximum : 5Mo.</small>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Détaillez votre idée *</label>
                            <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Domaine d'intérêts *</label>
                            @foreach (\App\Enums\Category::cases() as $category)
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="category"
                                    id="{{ $category->value }}"
                                    value="{{ $category->value }}"
                                    required>
                                <label class="form-check-label" for="{{ $category->value }}">
                                    {{ ucwords(str_replace('_', ' ', $category->name)) }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" id="username" name="username" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Votre email *</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                            <small class="form-text text-muted">Un lien de confirmation vous sera envoyé.</small>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="mb-2">
                                <label class="form-label" for="showUser">Voulez-vous être anonyme ?</label>
                            </div>
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="showUser" name="showUser">
                                    <label class="form-check-label" for="showUser">Oui</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="NotShowUser" name="NotShowUser">
                                    <label class="form-check-label" for="NotShowUser">Non</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-3 mt-3">
                            <input class="form-check-input" type="checkbox" id="notify" name="notify">
                            <label class="form-check-label" for="notify">Être notifié : 'Recevoir une notification du status de la demande'</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="consent" name="consent" required>
                            <label class="form-check-label" for="consent">Je consens à ce que RéCitraite les données que j’ai renseignées.</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Contribuer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>

    <script src="/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    @vite(['resources/js/app.js'])



    @stack('scripts')
    <script src="/bootstrap/dist/js/emojiPicker.js"></script>
    <script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script>
        function showToast(message, type) {
            switch (type) {
                case 'error':
                case 'danger':
                    toastr.error(message);
                    break;
                case 'warning':
                    toastr.warning(message);
                    break;
                case 'success':
                    toastr.success(message);
                    break;
                default:
                    toastr.info(message);
                    break;
            }
        }

        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-center",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
        };
        document.addEventListener('DOMContentLoaded', function() {
            const token = document.querySelector('meta[name="bearer-token"]')?.getAttribute('content');
            if (token) {
                localStorage.setItem('token', token);
            }
        });

        if ("{{ session('logout') }}" === 'true') {
            localStorage.removeItem('token');
        }
        let lastScrollTop = 0;
        const navbar = document.querySelector('.nav-bar');
        const logo = document.getElementById('logo-img');
        const menuToggleBtn = document.getElementById('mobileMenuToggle');

        window.addEventListener('scroll', function() {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            menuToggleBtn.style.color = '#000';
            // Scroll Down
            if (currentScroll > lastScrollTop) {
                navbar.classList.add('fixed'); // Add fixed class when scrolling down

                // Change logo to black when scrolling down
                logo.src = '/images/logo_reci_noir.png';

                // Change menu toggle button color when fixed
                if (menuToggleBtn) {
                    menuToggleBtn.style.color = '#000'; // Black color for fixed navbar
                }
            }

            // When scroll reaches the top of the page, reset the navbar
            if (currentScroll <= 0) {
                navbar.classList.remove('fixed'); // Remove fixed class when at the top

                // Change logo back to white
                logo.src = '/images/logo_reci_blanc.png';

                // Reset menu toggle button color
                if (menuToggleBtn) {
                    menuToggleBtn.style.color = '#fff'; // White color for default navbar
                }
            }

            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Prevent negative scroll
        });
    </script>

</body>

</html>
