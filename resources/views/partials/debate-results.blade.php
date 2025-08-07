@if (isset($searchTerm))
    <div class="container my-3">
        <x-section-title text='Résultats pour : "{{ $searchTerm }}" ' />
    </div>
@else
    <x-section-title text="Les débats récents :" />
@endif

<div class="row">
    @php
        $validDebates = $debates->where('statut', 'Validé')->take(4);
    @endphp

    @if ($validDebates->isEmpty())
        <div class="col-12 text-center py-5">
            <p class="text-muted">Aucun résultat trouvé pour "{{ $searchTerm }}".</p>
        </div>
    @else
        @foreach ($validDebates as $card)
            <div class="col-md-6 mb-4">
                <x-post-card
                    :category="$card['category']"
                    :id="$card['id_debat']"
                    :date="$card['created_at']"
                    :title="$card['titre']"
                    :description="$card['description']"
                    :image="$card['image']"
                    :status="$card['statut']"
                    :comments="$card->commentaires_count"
                    :likes="$card->votes_count"
                    :views="0"
                />
            </div>
        @endforeach
    @endif
</div>
