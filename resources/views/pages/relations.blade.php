@extends('layouts.app')


<!-- title -->
@section('title') RéCi| Santé @endSection

<!-- content -->
@section('content')
@include('layouts.header2', ['header_title' => 'Relations internationales et intégration régionale', 'header_subtitle' => 'Diplomatie, commerce international, organisations régionales (CEDEAO, Union africaine).' ])


<div class="section">
    <div class="post-sections mb-4">
        <div class="container my-5 ">

            <x-section-title text="Les débats sur les 'Relations internationales et intégration régionale':" />
            <div class="row">
                @foreach ($post_cards as $card)
                <div class="col-md-6 mb-4">
                    <x-post-card
                        :category="$card['category']"
                        :date="$card['date']"
                        :title="$card['title']"
                        :description="$card['description']"
                        :image="$card['image']"
                        :status="$card['status']"
                        :comments="$card['commentaires_count']"
                        :likes="$card['votes_count']"
                        :views="$card['views']" />
                </div>
                @endforeach
                <p>Aucun sujet de débat dans cette catégorie</p>

            </div>
        </div>
    </div>
</div>

<div class="p-4 d-flex">

        <div class="divider mt-4 m-4"></div>
    </div>

<div class="domain-body ">
        <x-title text="les domaines d’interets" class="mb-4" />

        <div class="container mb-4">
            <div class="row d-list">
                @foreach ($cards as $card)
                <x-card

                    :id="$card['id_debat']"
                    title="{{ $card['title'] }}"
                    text="{{ $card['text'] }}"
                    actionUrl="{{ $card['actionUrl'] }}"
                    actionText="{{ $card['actionText'] }}"
                    bgColor="{{ $card['bgColor'] }}" />

                @endforeach



            </div>
        </div>
        <!-- import domain list base on db query -->
    </div>
@include('layouts.footer')

<!-- call footer -->
@endsection

<!-- scripts -->
@push('script')
<script></script>
@endpush
