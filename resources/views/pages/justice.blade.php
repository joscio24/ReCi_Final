@extends('layouts.app')


<!-- title -->
@section('title') RéCi| Justice @endSection

<!-- content -->
@section('content')
@include('layouts.header2', ['header_title' => 'Justice', 'header_subtitle' => 'Construire un système judiciaire fort et inclusif' ])


<div class="section">
    <div class="post-sections mb-4">
        <div class="container my-5 ">

            <x-section-title text="Les débats sur la justice au bénin." />
            <div class="row">
                @foreach ($post_cards as $card)
                <div class="col-md-6 mb-4">
                    <x-post-card
                        :category="$card['category']"
                        :id="$card['id_debat']"
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
            </div>
        </div>
    </div>
</div>

<div class="p-4 d-flex">

    <div class="divider mt-4 m-4"></div>
</div>

<div class="domain-body ">
    <x-title text="Les domaines d’interets" class="mb-4" />

    <div class="container mb-4">
        <div class="row d-list">
            @foreach ($cards as $cards)
            <x-card
                title="{{ $cards['title'] }}"
                text="{{ $cards['text'] }}"
                actionUrl="{{ $cards['actionUrl'] }}"
                actionText="{{ $cards['actionText'] }}"
                bgColor="{{ $cards['bgColor'] }}" />

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
