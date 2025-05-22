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

                    <li><a href="/login">Se connecter</a></li>
                    <li><a href="/register">S'inscrire</a></li>
                @endguest
                <li><a href="#si" class="menu-link active text-white" style="font-size: medium; font-weight: 900;"
                    data-bs-toggle="modal" data-bs-target="delete#contributionModal">Lancer un débat</a></li>
                <li><a href="https://reci.bj/faq/">FAQ</a></li>
                <li><a href="https://reci.bj/apropos/">À propos</a></li>
                <li><a href="https://reci.bj/rejoindre/" class="text-white fw-bold fs-6 mt-4">Contact</a></li>


            </ul>
        </div>
    </div>
    <div class="footer-bottom p-4">
        <div class="footer-links-bottom">
            <a href="https://reci.bj/politique-de-confidentialite/">Privacy</a>
            <a href="#">Cookies</a>

            <a href="https://reci.bj/politique-de-confidentialite/">Terms and conditions</a>
        </div>
        <div class="footer-legal d-flex justify-content-between mt-4"
            style="justify-content: space-between; gap: 40px; ">
            <p>
                <span class="license">RéCi</span>
                            <p>© 2024</p>
                <a href="#" style="color: white;"></a>
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
