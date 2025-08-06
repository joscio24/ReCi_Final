<footer class="footer ">
    <div class="footer-content p-4">

        <div class="footer-section">
            <h3>Domaines d’intérêts</h3>
            <hr class="divider-hr">

            <div class="footer-links">
                <ul>
                    <li><a href="/education">Education</a></li>
                    <li><a href="/justice">Justice</a></li>
                    <li><a href="/politique">Politique</a></li>
                </ul>
                <ul>
                    <li><a href="/sante">Santé & Social</a></li>
                    <li><a href="/relations_internationales">Relations internationales</a></li>
                    <li><a href="/economie">Economie</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-section">
            <h3>Contribuer</h3>
            <hr class="divider-hr">
            <ul>
                @guest

                    <li><a href="/login" style="font-size: medium; font-weight: 900;">Se connecter</a></li>
                    <li><a href="/register" style="font-size: medium; font-weight: 900;">S'inscrire</a></li>
                @endguest
                <li><a href="#si" class="menu-link active text-white" style="font-size: medium; font-weight: 900;"
                        data-bs-toggle="modal" data-bs-target="delete#contributionModal">Lancer un débat</a></li>
                <li><a href="https://reci.bj/faq/" style="font-size: medium; font-weight: 900;">FAQ</a></li>
                <li><a href="https://reci.bj/apropos/" style="font-size: medium; font-weight: 900;">À propos</a></li>
                <li><a href="https://reci.bj/rejoindre/" class="text-white fw-bold fs-6 mt-4">Contact</a></li>


            </ul>
        </div>
    </div>
    <div class="footer-bottom p-4">
        <div class="footer-links-bottom">
            <a href="https://reci.bj/politique-de-confidentialite/">Privacy</a>
            @if (auth()->check())
                <!-- Cookies link -->
                <a href="#" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#cookiesModal">
                    Cookies
                </a>

                <!-- Cookies Modal -->
                <div class="modal fade" id="cookiesModal" tabindex="-1" aria-labelledby="cookiesModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cookiesModalLabel">Consentement aux cookies</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                Ce site utilise des cookies pour améliorer votre expérience utilisateur. En continuant,
                                vous acceptez notre politique de confidentialité.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Refuser</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Accepter</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <a href="https://reci.bj/politique-de-confidentialite/">Terms and conditions</a>
        </div>
        <div class="footer-legal d-flex justify-content-between mt-4"
            style="justify-content: space-between; gap: 40px; ">
            <p style="font-size: medium; font-weight: 900;">
                <span class="license">Réflexions Citoyennes &copy; {{ date('Y') }}</span>


            </p>
        </div>
        <div class="footer-logo">
            <div class="logo">
                <img id="logo-img" src="/images/logo_reci_blanc.png" alt="Logo" />
            </div>
            {{-- <p>Réflexions Citoyennes</p> --}}
        </div>
    </div>
</footer>
