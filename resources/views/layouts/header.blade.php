<div class="header header-section">
    <div class="header-content">
        <!-- Navigation bar -->
        @include('components.navbar')

        <!-- Header content -->
        <div class="header-brand-section">
            <!-- Left section -->
            <div class="col-md-6 header-left">
                <h1 class="text-white">RéCi :</h1>
                <p>Plateforme citoyenne de débats et de co-création</p>
            </div>

            <!-- Right section -->
            <div class="col-md-6 header-right">
                <div class="search-container">
                    <!-- Rechercher text -->
                    <h2 class="search-background-text">Rechercher</h2>

                    <!-- Search form -->
                    <form class="search-form ">
                        <input
                            type="text"
                            placeholder="Rechercher par mots clé ou domaine d'intérêt..."
                            class="search-input" />
                        <button type="submit" class="search-button">
                            <i class="fa fa-search"></i> <!-- Font Awesome icon -->
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
