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
                    {{-- <form class="search-form ">
                        <input
                            type="text"
                            placeholder="Rechercher par mots clé ou domaine d'intérêt..."
                            class="search-input" />
                        <button type="submit" class="search-button">
                            <i class="fa fa-search"></i> <!-- Font Awesome icon -->
                        </button>
                    </form> --}}
                    <form class="search-form" id="searchForm" action="{{ route('search.debates') }}" method="GET">
                        <input
                            type="text"
                            name="q"
                            placeholder="Rechercher par mots clé ou domaine d'intérêt..."
                            class="search-input"
                            value="{{ request('q') }}"
                        />
                        <button type="submit" class="search-button">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let debounceTimer;

        const $searchInput = $('input[name="q"]');
        const $searchResults = $('#searchResults');
        const $defaultContent = $('#defaultContent');
        const $searchForm = $('#searchForm');

        $searchInput.on('input', function () {
            const query = $(this).val();
            const url = $searchForm.attr('action');

            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(function () {
                if (query.length > 1) {
                    $defaultContent.hide(); // 🔴 Hide default container

                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: { q: query },
                        beforeSend: function () {
                            $searchResults.html('<p>Recherche en cours...</p>');
                        },
                        success: function (response) {
                            $searchResults.html(response.html);
                        },
                        error: function () {
                            $searchResults.html('<p>Erreur lors de la recherche.</p>');
                        }
                    });
                } else {
                    $defaultContent.show(); // 🟢 Show default container back

                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: {},
                        success: function (response) {
                            $searchResults.html(response.html);
                        }
                    });
                }
            }, 400); // 400ms debounce delay
        });
    });
</script>



