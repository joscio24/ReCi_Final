@extends('layouts.app')


<!-- title -->
@section('title') RéCi| Débats @endSection

<!-- content -->
@section('content')
@include('layouts.header2', ['header_title' => 'Débats', 'header_subtitle' => '' ])


<div class="section">
    <div class="post-sections mb-4">
        <div class="container my-5 ">

            <x-section-title text="Tous les débats au bénin:" />
            <div class="row">
                @foreach ($debats->take(10) as $debat)
                <div class="col-md-6 mb-4">
                    <x-post-card
                        category="{{ $debat['category'] }}"
                        id="{{ $debat['id_debat'] }}"
                        date="{{ $debat['created_at'] }}"
                        title="{{ $debat['titre'] }}"
                        :description="$debat['description']"
                        image="{{ $debat['image'] }}"
                        status="{{ $debat['status'] }}"
                        comments="{{ $debat->commentaires_count }}"
                        likes="{{ $debat->votes_count}}"
                        views="0" />
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
