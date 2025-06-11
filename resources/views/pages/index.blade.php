@extends('layouts.app')


<!-- title -->
@section('title')
    RéCi| Acceuil
@endSection

<!-- content -->
@section('content')
    @include('layouts.header')
    <section class="home-body p-4" id="domaine-interet" style="">

        <div class="post-sections mb-4">

            <div class="container" style="margin-top: -6rem">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

                <div class="container py-5">
                    <div class="row g-4">
                        <!-- Card 1 -->
                        <div class="col-md-4">
                            <div class="card h-100 text-center shadow-lg">
                                <div class="card-body">
                                    <div class="display-3 mb-3">🗣️</div>
                                    <h5 class="card-title fw-bold">Exprime-toi librement</h5>
                                    <p class="card-text text-muted">
                                        Une plateforme ouverte favorise l’expression d’idées et de préoccupations, stimulant
                                        un véritable dialogue citoyen constructif.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-md-4">
                            <div class="card h-100 text-center shadow-lg">
                                <div class="card-body">
                                    <div class="display-3 mb-3">🧠</div>
                                    <h5 class="card-title fw-bold">Les idées font bouger le pays</h5>
                                    <p class="card-text text-muted">
                                        Le débat public met en lumière les solutions citoyennes et permet à chaque voix de
                                        contribuer à l’amélioration de la vie collective.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-md-4">
                            <div class="card h-100 text-center shadow-lg">
                                <div class="card-body">
                                    <div class="display-3 mb-3">🤝</div>
                                    <h5 class="card-title fw-bold">Agir ensemble, c’est plus fort</h5>
                                    <p class="card-text text-muted">
                                        En rassemblant les citoyens autour d’enjeux communs, la discussion renforce le
                                        sentiment d’appartenance et l’action collective.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="container my-5 ">

                <x-section-title text="Les débats récents :" />
                <div class="row">
                    @foreach ($debates->where('statut', 'Validé')->take(4) as $card)
                        <div class="col-md-6 mb-4">
                            <x-post-card :category="$card['category']" :id="$card['id_debat']" :date="$card['created_at']" :title="$card['titre']"
                                :description="$card['description']" :image="$card['image']" :status="$card['statut']" :comments="$card->commentaires_count" :likes="$card->votes_count"
                                :views="0" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="domain-body ">

            <x-title text="Quelques domaines d’interets" class="mb-4" />

            <div class="container mb-4">
                <div class="row d-list p-" style="">
                    @foreach ($cards as $card)
                        <x-card title="{{ $card['title'] }}" text="{{ $card['text'] }}" actionUrl="{{ $card['actionUrl'] }}"
                            actionText="{{ $card['actionText'] }}" bgColor="{{ $card['bgColor'] }}" />
                    @endforeach



                </div>
            </div>
            <!-- import domain list base on db query -->
        </div>

        <div class="p-4 d-flex">

            <div class="divider mt-4 m-4"></div>
        </div>

        <div class="post-sections mb-4">
            <div class="container my-5 ">

                <x-section-title text="Les débats les plus actifs :" />
                <div class="row">
                    @foreach ($debates->take(4) as $card)
                        <div class="col-md-6 mb-4">
                            <x-post-card :category="$card['category']" :id="$card['id_debat']" :date="$card['created_at']" :title="$card['titre']"
                                :description="$card['description']" :image="$card['image']" :status="$card['statut']" :comments="$card->commentaires_count"
                                :likes="$card->votes_count" :views="0" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="container-fluid row d-none">

            <div class="w-100 row mt-4">
                <div class="left left-1" hidden>
                    <x-section-title text="Sujets de débats en cours :" />
                </div>
                <div class="right right-1">
                    <x-section-title text="Liens utiles" />
                </div>
            </div>
            <div class="left" hidden>
                @foreach ($debates->take(5) as $index => $debate)
                    <x-ListItemComponent :id="$debate['id']" :title="$debate['titre']" :description="$debate['description']" :index="$index" />
                @endforeach
            </div>
            <div class="righ">
                <div class="row p- d-flex w-100 d" style="gap: 15px;">

                    @foreach ($links as $index => $link)
                        <x-link-item-component class="" :title="$link['title']" :description="$link['description']" :index="$index"
                            :icon="$link['icon']" />
                    @endforeach


                </div>
            </div>
        </div>




    </section>


    @include('layouts.footer')

    <!-- call footer -->
@endsection

<!-- scripts -->
@push('script')
    <script></script>
@endpush
