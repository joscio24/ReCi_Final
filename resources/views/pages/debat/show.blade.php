@extends('layouts.app')


<!-- title -->
@section('title')
    ReCi/débat | {{ $debat->title }}
@endSection

<!-- content -->
@section('content')
    @include('layouts.header3', [
        'header_title' => 'Débat',
        'header_subtitle' => $debat->titre,
        'post_image' => $debat->image,
    ])


    <!--  -->
    <style>
        .message_form {
            /* flex-grow: 1; */
            width: 100%;
            resize: none;
            overflow: none;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 14px;
        }

        /* Comment Section Container */
        /* .comment-section {
                                                            max-width: 700px;
                                                            margin: auto;
                                                            font-family: Arial, sans-serif;
                                                        } */

        /* Comment Box */
        /* .comment {
                                                            display: flex;
                                                            align-items: flex-start;
                                                            background: #f9f9f9;
                                                            border-radius: 8px;
                                                            padding: 12px;
                                                            margin-bottom: 10px;
                                                            position: relative;
                                                        } */

        .comment-holder {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            max-width: 100%;
        }

        .comment {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            width: 100%;
        }

        .user-icon {
            font-size: 20px;
            color: gray;
        }

        .comment-content {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
            max-width: 100%;
            word-wrap: break-word;
            width: calc(100% - 30px);
        }

        .comment-content {
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: flex-start;
        }

        .username {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .comment-message {
            margin-bottom: 5px;
            line-height: 1.4;
            word-break: break-word;
        }

        .date {
            font-size: 12px;
            color: #888;
        }

        /* Reply Section */
        .replies {
            margin-left: 30px;
            /* margin-top: 5px; */
            padding-left: 0px;
            border-left: 2px solid #ccc;
            /* Facebook-style branching */
        }

        .reply {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
            gap: 10px;
        }

        /* .reply-line {
                                                    width: 2px;
                                                    background-color: #ccc;
                                                    margin-left: 10px;
                                                } */

        .reply-line {
            position: relative;
            top: 0;
            /* left: -12px; */
            z-index: 89999;
            width: 50px;
            /* Horizontal part */
            height: 20px;
            /* Vertical part */
            border-left: 2px solid #ccc;
            /* Vertical line */
            border-bottom: 2px solid #ccc;
            border-bottom-left-radius: 10px;
            /* Horizontal line */
            margin-left: -1px;
        }


        .reply-box {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            width: 100%;
        }

        .reply-content {
            background: #f1f1f1;
            padding: 8px;
            border-radius: 8px;
            max-width: 100%;
            word-wrap: break-word;
            width: calc(100% - 30px);
        }

        /* Reply Form */
        .reply-form {
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .reply-input {
            width: 80%;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .reply-form button {
            padding: 5px 10px;
        }

        /* User Icon */
        .user-icon {
            width: 40px;
            height: 40px;
            background: #007bff;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            border-radius: 50%;
            margin-right: 12px;
        }

        /* Like Button */
        .like-btn {
            border: none;
            background: none;
            color: #888;
            cursor: pointer;
            font-size: 14px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .like-btn i {
            color: red;
            font-size: 16px;
            transition: 0.3s ease;
        }

        .like-btn:hover i {
            transform: scale(1.2);
        }

        /* Reply Button */
        .reply-btn {
            background: none;
            border: none;
            color: #007bff;
            font-size: 14px;
            cursor: pointer;
            margin-left: 10px;
        }

        .reply-btn:hover {
            text-decoration: underline;
        }

        /* Reply Form */
        .reply-form {
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .reply-input {
            flex: 1;
            padding: 6px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .reply-form button {
            background: #007bff;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .reply-form button:hover {
            background: #0056b3;
        }

        /* Replies Container */
        .replies {
            margin-left: 50px;
            /* margin-top: 10px; */
        }

        .no-border {
            border-left: none !important;
        }


        /* Individual Reply */
        .reply {
            display: flex;
            align-items: flex-start;
            background: #f1f1f1;
            border-radius: 6px;
            padding: 8px;
            margin-bottom: 6px;
            position: relative;
        }

        /* User Icon in Reply */
        .reply .user-icon {
            width: 30px;
            height: 30px;
            font-size: 14px;
            margin-right: 10px;
        }

        /* Reply Content */
        .reply-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: start;
        }

        .reply-content h6 {
            margin: 0;
            font-size: 13px;
            font-weight: bold;
            color: #444;
        }

        .reply-content p {
            margin: 0px 0;
            font-size: 13px;
            color: #666;
        }

        .reply-content .text-muted {
            font-size: 11px;
            color: #888;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .comment {
                flex-direction: column;
            }

            .user-icon {
                margin-bottom: 5px;
            }

            .replies {
                margin-left: 20px;
            }
        }

        .vote-count-box {
            background: white;
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-left: 5px;
            font-weight: bold;
        }
    </style>
    <div class="container my-4">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <article class="p-1">
                    <!-- <div class="card p-2">
                                                                                                <h1 class="mb-3">{{ $debat->title }}</h1>

                                                                                            </div> -->
                    <!-- <div class="post-img" style="background-image: url('/images{{ $debat->image }}'); "> -->
                    <div class="post-img" style="background-image: url('{{ Storage::url($debat->image) }}'); ">

                    </div>
                    <div class="post-description card p-4">
                        <p>{{ $debat->description }}</p>

                    </div>

                    <div class="card p-2">
                        <div class="row align-items-center">
                            <!-- Like Button -->

                            <p>Proposé par: <strong>{{ $debat->user->name }}</strong> |
                                {{ \Carbon\Carbon::parse($debat->Ddate)->translatedFormat('d F Y') }}
                            </p>
                            <div class="col-auto">

                                <div class="icon-with-badge d-flex b b -center " style="jusyify-content:center; ">
                                    <!-- voter -->
                                    <span class="me-3 d-icon" style="cursor: pointer;">
                                        <i id="likeIcon"
                                            class="fi  like-button {{ $userHasVoted ? 'fi-sr-heart text-primary' : 'fi-rr-heart' }}"
                                            onclick="likeDebate({{ $debat->id_debat }}, true, {{ auth()->id() }});"></i>
                                    </span>

                                    <span class="badge like-count"
                                        id="like-count-{{ $debat->id_debat }}">{{ $debat->votes_count }}</span>
                                </div>
                            </div>

                            <!-- <span style="width: 50px;"></span> -->
                            <!-- Comment Count -->
                            <div class="col-auto">
                                <div class="icon-with-badge">
                                    <span class="me-3 d-icon">
                                        <i class="fi fi-rr-messages"></i>
                                    </span>
                                    <span class="badge">{{ $debat->commentaires_count }}</span>
                                </div>
                            </div>

                            <!-- Share Icon -->
                            <div class="col-auto">
                                <div class="icon-with-badge">
                                    <span class="me-3 d-icon" onclick="openShareModal()">
                                        <i class="fi fi-rr-share"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-auto {{ $userHasVoted }}">
                                <div class="d-flex b -center mt-2" style="gap: 20px; justify-content: center;">
                                    <!-- "Pour" (Like) Button -->
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-success d-flex align-items-center"
                                            onclick="likeDebate({{ $debat->id_debat }}, true, {{ auth()->id() }});">
                                            <i class="fas fa-thumbs-up"></i> Je suis intéressé
                                        </button>
                                        <span class="vote-count-box"
                                            id="like-count-{{ $debat->id_debat }}">{{ $likesCount }}</span>
                                    </div>

                                    <!-- "Contre" (Dislike) Button -->
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-danger d-flex align-items-center"
                                            onclick="likeDebate({{ $debat->id_debat }}, false, {{ auth()->id() }});">
                                            <i class="fas fa-thumbs-down"></i> Je ne suis pas intéressé
                                        </button>
                                        <span hidden class="vote-count-box"
                                            id="dislike-count-{{ $debat->id_debat }}">{{ $dislikesCount ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>




                    <!-- /images{{ $debat->image }} -->

                </article>
                <!-- Comment Section -->
                <section id="comments" class="mt-4">
                    <h2>Commentaires</h2>
                    <!-- <div class="comment-section">
                                                                                                @foreach ($comments as $comment)
    <div class="comment">
                                                                                                    <span class="user-icon">
                                                                                                        <i class="fi fi-rr-user"></i>
                                                                                                    </span>
                                                                                                    <div class="comment-content">
                                                                                                        <h5>{{ $comment->user->name }}</h5>
                                                                                                        <p>{{ $comment->texte }}</p>

                                                                                                        <span class="text-muted">{{ $comment->date_commentaire }}</span>
                                                                                                    </div>
                                                                                                </div>
    @endforeach
                                                                                            </div> -->





                    <section id="comments" class="mt-4">

                        <div class="row  mb-2">
                            <!-- Left Column: "For" Comments -->
                            <div class="col-md-6">
                                <h3 class="text-success">Pour</h3>
                                <div class="comment-section card "
                                    style="overflow: scroll; scrollbar-width: none; {{ count($forComments) >= 0 ? 'height: 400px;' : 'height: 100px;' }} ">

                                    @if (count($forComments) > 0 )
                                        @foreach ($forComments as $comment)
                                            <div class="comment-holder">
                                                <div class="comment">
                                                    <span class="user-icon">
                                                        <i class="fi fi-rr-user"></i>
                                                    </span>
                                                    <div class="comment-content">
                                                        <h5 class="username">{{ $comment->user->name }}</h5>
                                                        <p class="comment-message">{{ $comment->texte }}</p>
                                                        <span
                                                            class="text-muted date">{{ $comment->date_commentaire }}</span>

                                                        <!-- Like Button -->
                                                        <button class="like-btn"
                                                            data-comment-id="{{ $comment->id_commentaire }}">
                                                            <i class="fi fi-rr-heart"></i> <span
                                                                class="like-count">{{ $comment->likes->count() }}</span>
                                                        </button>

                                                        <!-- Reply Button -->
                                                        <button class="reply-btn btn btn-sm btn-primary"
                                                            data-comment-id="{{ $comment->id_commentaire }}">
                                                            Répondre
                                                        </button>

                                                        <!-- Reply Form (Hidden by Default) -->
                                                        <form class="reply-form"
                                                            data-comment-id="{{ $comment->id_commentaire }}"
                                                            style="display: none;">
                                                            @csrf
                                                            <input type="text" class="reply-input" name="reply_text"
                                                                placeholder="Votre réponse..." required>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary">Envoyer</button>
                                                        </form>

                                                    </div>
                                                </div>

                                                <!-- Replies Section -->
                                                <div class="replies {{ count($comment->replies) < 2 ? 'no-border' : '' }}">
                                                    @foreach ($comment->replies as $reply)
                                                        <div class="d-flex">
                                                            <div class="reply-line"></div>
                                                            <div class="reply mt-2"> <!-- Visual Connection -->
                                                                <div class="reply-box">
                                                                    <span class="user-icon"><i
                                                                            class="fi fi-rr-user"></i></span>
                                                                    <div class="reply-content">
                                                                        <h6 class="username">{{ $reply->user->name }}</h6>
                                                                        <p class="comment-message">{{ $reply->texte }}</p>
                                                                        <span
                                                                            class="text-muted date">{{ $reply->date_commentaire }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    @else

                                            <div class="text-center h-100 w-100 d-flex"
                                                style="flex-direction: column; justify-content: center;">
                                                <p>Aucun commentaire</p>
                                            </div>

                                    @endif
                                </div>
                            </div>

                            <!-- Right Column: "Against" or "Indecisive" Comments -->
                            <div class="col-md-6">
                                <h3 class="text-danger">Contre ou Indécis</h3>
                                <div class="comment-section card "
                                    style="overflow: scroll; scrollbar-width: none; {{ count($forComments) >= 0 ? 'height: 400px;' : 'height: 100px;' }} ;">
                                    @if (count($againstComments) > 0)
                                        @foreach ($againstComments as $comment)
                                            <div class="comment-holder">
                                                <div class="comment">
                                                    <span class="user-icon">
                                                        <i class="fi fi-rr-user"></i>
                                                    </span>
                                                    <div class="comment-content">
                                                        <h5 class="username">{{ $comment->user->name }}</h5>
                                                        <p class="comment-message">{{ $comment->texte }}</p>
                                                        <span
                                                            class="text-muted date">{{ $comment->date_commentaire }}</span>

                                                        <!-- Like Button -->
                                                        <button class="like-btn"
                                                            data-comment-id="{{ $comment->id_commentaire }}">
                                                            <i class="fi fi-rr-heart"></i> <span
                                                                class="like-count">{{ $comment->likes->count() }}</span>
                                                        </button>

                                                        <!-- Reply Button -->
                                                        <button class="reply-btn btn btn-sm btn-primary"
                                                            data-comment-id="{{ $comment->id_commentaire }}">
                                                            Répondre
                                                        </button>

                                                        <!-- Reply Form (Hidden by Default) -->
                                                        <form class="reply-form"
                                                            data-comment-id="{{ $comment->id_commentaire }}"
                                                            style="display: none;">
                                                            @csrf
                                                            <input type="text" class="reply-input" name="reply_text"
                                                                placeholder="Votre réponse..." required>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary">Envoyer</button>
                                                        </form>
                                                    </div>
                                                </div>

                                                <!-- Replies Section -->
                                                <div
                                                    class="replies {{ count($comment->replies) < 2 ? 'no-border' : '' }}">
                                                    @foreach ($comment->replies as $reply)
                                                        <div class="d-flex w-100">
                                                            <div class="reply-line"></div>
                                                            <div class="reply mt-2"> <!-- Visual Connection -->
                                                                <div class="reply-box">
                                                                    <span class="user-icon"><i
                                                                            class="fi fi-rr-user"></i></span>
                                                                    <div class="reply-content">
                                                                        <h6 class="username">{{ $reply->user->name }}</h6>
                                                                        <p class="comment-message">{{ $reply->texte }}</p>
                                                                        <span
                                                                            class="text-muted date">{{ $reply->date_commentaire }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center h-100 w-100 d-flex"
                                            style="flex-direction: column; justify-content: center;">
                                            <p>Aucun commentaire</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>




                    <form id="comment-form" class="card container p-2">
                        @csrf
                        <h4>Laisser un commentaire</h4>
                        <input type="hidden" name="id_debat" value="{{ $debat->id_debat }}">
                        @guest
                            <div class="mb-3">
                                <label for="comment-name" class="form-label">Nom</label>
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="comment-email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                        @endguest
                        <div class="mb-3">
                            <label for="comment-content" class="form-label">Commentaire</label>
                            <textarea name="content" class="form-control" rows="4" placeholder="Votre commentaire" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </form>
                </section>
            </div>
            <!-- Sidebar -->
            <div class="col-lg-4">

                <!-- chat section -->
                <aside class="mb-4">
                    <section>
                        <div class="card" id="chat-section-holder">
                            <div class="card-header d-flex justify-content-between align-items-center p-3">
                                <h5 class="mb-0">Discussions sur le sujet</h5>
                                <button type="button" class="btn btn-primary btn-sm" id="toggleFullscreenBtn"
                                    title="Maximmiser -plein écran">
                                    <i id="toggleIcon" class="fas fa-expand"></i>
                                </button>

                            </div>
                            <div class="card-body chat-containers"
                                style="position: relative; height: 400px; overflow-y: auto; scrollbar-width:thin;">
                                <div id="chat-section">
                                    @auth
                                        @if ($messages->count() > 0)
                                            @php $today = \Carbon\Carbon::today(); @endphp
                                            @foreach ($messages->reverse() as $key => $message)
                                                @if ($key === 0 || $message->created_at->format('Y-m-d') !== $messages[$key - 1]->created_at->format('Y-m-d'))
                                                    <div class="divider d-flex align-items-center mb-4">
                                                        <p class="text-center mx-3 mb-0" style="color: #a2aab7;">
                                                            {{ $message->created_at->isToday() ? 'Aujourd\'hui' : $message->created_at->format('d M Y') }}
                                                        </p>
                                                    </div>
                                                @endif
                                                @if ($message->id_user === auth()->id())
                                                    <!-- Sent Message -->
                                                    <div class="d-flex flex-row justify-content-end mb-4">
                                                        <div>
                                                            <p style="border-radius: 20px;
                                                                                                                                                border-bottom-right-radius: 0;"
                                                                class="small  active_sender p-2 me-3 mb-1 text-white  bg-primary">
                                                                {{ $message->texte }}
                                                            </p>
                                                            <p
                                                                class="small me-2 mb-3 rounded-3 text-muted d-flex justify-content-end">
                                                                {{ $message->created_at->format('H:i') }}
                                                            </p>
                                                        </div>
                                                        <img class="d-none"
                                                            src="{{ asset($message->user->profile_image ?? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4-bg.webp') }}"
                                                            alt="avatar" width="30px" height="30px">
                                                    </div>
                                                @else
                                                    <!-- Received Message -->
                                                    <div class="d-flex flex-row justify-content-start mb-4">
                                                        <img class="d-none"
                                                            src="{{ asset($message->user->profile_image ?? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3-bg.webp') }}"
                                                            alt="avatar" width="30px" height="30px">
                                                        <div>
                                                            <p style="border-radius: 20px;
                                                                                                                                                border-bottom-left-radius: 0;"
                                                                class="small p-2 ms-3 mb-1 rounded-3 bg-white">
                                                                {{ $message->texte }}
                                                            </p>
                                                            <p class="small ms-3 mb-3 rounded-3 text-muted">
                                                                {{ $message->created_at->format('H:i') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <p class="text-center text-muted">Aucun message pour l'instant. Commencez la
                                                conversation !</p>
                                        @endif
                                    @endauth
                                    @guest
                                        <p class="text-center text-muted">
                                            <a
                                                href="{{ route('login', ['redirect' => request()->url()]) }}">Connectez-vous</a>
                                            pour accéder et participer à la discussion.
                                        </p>
                                    @endguest

                                    <!-- Typing Indicator (hidden by default) -->
                                </div>
                                <p id="typing-bubble" class=" mb-2" style="display:none; color:black;">
                                    <em id="type_text">typing...</em>
                                </p>
                            </div>

                            @auth
                                @if ($userHasVoted)
                                    <form method="POST" enctype="multipart/form-data" id="message_form"
                                        action="{{ route('messages.store', $debat->id_debat) }}" class="w-100 d-flex">
                                        @csrf

                                        <div class="w-100 h-100">
                                            <div class="card image-preview ">

                                            </div>
                                            <div
                                                class="card-footer message_form text-muted d-flex justify-content-between align-items-center p-3">
                                                <!-- Camera Button -->

                                                <!-- <button type="button" id="camera-button" class="btn btn-light btn-icon me-1" style="width: 40px; height: 40px;">
                                                                                                                                                                                                                    <i class="fas fa-camera text-muted"></i>
                                                                                                                                                                                                                </button> -->
                                                <!-- Photo Upload Input -->
                                                <!-- <input type="file" id="photo-upload" name="photo" style="display: none;"> -->

                                                <textarea name="texte" style="overflow: hidden; resize: none; height: 50px; width:100%;"
                                                    placeholder="Votre message..." required></textarea>

                                                <!-- <a class="ms-1 text-muted" href="javascript:void(0);" id="attachment-button"><i class="fas fa-paperclip"></i></a>
                                                                                                                                                                                                                <input type="file" id="attachment-upload" name="attachment" style="display: none;"> -->

                                                <!-- <a class="ms-3 text-muted" href="javascript:void(0);" id="emoji-button"><i class="fas fa-smile"></i></a> -->
                                                <button class="ms-3 btn btn-primary border-none" type="submit"
                                                    href="#!"><i class="fas fa-paper-plane"></i></button>
                                            </div>
                                        </div>

                                    </form>
                                @else
                                    <p class="p-2">Vous devez voter oui pour le débat pour pourvoir participer à la
                                        discussion
                                        . Cliquez sur le bouton 'Je suis intéressé'</p>
                                @endif
                            @endauth
                        </div>
                    </section>
                </aside>


                <!-- debats recents -->

                <aside>
                    <h2>Débats récents</h2>
                    <ul class="list-unstyled">

                        @foreach ($recent_posts as $post)
                            <x-debat id="{{ $post['id_debat'] }}" category="{{ $post['category'] }}"
                                date="{{ $post['date'] }}" title="{{ $post['titre'] }}"
                                description="{{ $post['description'] }}" image="{{ $post['image'] }}" />
                        @endforeach
                    </ul>
                </aside>
            </div>
        </div>
    </div>


    <div class="p-4 d-flex">

        <div class="divider mt-4 m-4"></div>
    </div>





    @include('layouts.footer')

    <!-- call footer -->
@endsection

<!-- scripts -->

@vite(['resources/js/app.js'])
@push('scripts')
    <div id="shareModal" class="modal fade" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shareModalLabel">Partager le débat</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h6>Sélectionnez une plateforme pour le partage:</h6>
                    <div class="d-flex justify-content-around">
                        <button class="btn btn-primary" onclick="shareToFacebook()">Facebook</button>
                        <button class="btn btn-info" onclick="shareToLinkedIn()">LinkedIn</button>
                        <button class="btn btn-success" onclick="shareToWhatsApp()">WhatsApp</button>
                        <button class="btn btn-dark" onclick="shareToInstagram()">Instagram</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        // Function to open the share modal and prevent navigation
        function openShareModal() {
            // Prevent the default link behavior
            const link = document.getElementById('shareLink'); // Store the link element

            // Open the share modal (Bootstrap modal)
            var myModal = new bootstrap.Modal(document.getElementById('shareModal'));
            myModal.show();

            // Store the link so it can be opened after sharing
            sessionStorage.setItem('shareLink', link.href); // Store the URL for later
        }

        // Function to share to Facebook
        function shareToFacebook() {
            const url = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
            window.open(url, '_blank', 'width=600,height=400');
            closeModalAndRedirect();
        }

        // Function to share to LinkedIn
        function shareToLinkedIn() {
            const url = "https://www.linkedin.com/shareArticle?mini=true&url=" + encodeURIComponent(window.location.href);
            window.open(url, '_blank', 'width=600,height=400');
            closeModalAndRedirect();
        }

        // Function to share to WhatsApp
        function shareToWhatsApp() {
            const url = "https://api.whatsapp.com/send?text=" + encodeURIComponent(window.location.href);
            window.open(url, '_blank', 'width=600,height=400');
            closeModalAndRedirect();
        }

        // Function to share to Instagram (Not applicable via web)
        function shareToInstagram() {
            const url = "https://www.instagram.com/";
            window.open(url, '_blank', 'width=600,height=400');
            closeModalAndRedirect();
        }

        // Function to close the modal and redirect the user after sharing
        function closeModalAndRedirect() {
            var myModal = new bootstrap.Modal(document.getElementById('shareModal'));
            myModal.hide();

            // Retrieve the saved link and redirect the user to the original page
            const link = sessionStorage.getItem('shareLink');
            if (link) {
                window.location.href = link; // Navigate to the original page
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Handle Like
            document.querySelectorAll(".like-btn").forEach(button => {
                button.addEventListener("click", function() {
                    let commentId = this.getAttribute("data-comment-id");
                    let likeCountSpan = this.querySelector(".like-count");

                    fetch(`/comment/${commentId}/like`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                "Content-Type": "application/json"
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            likeCountSpan.textContent = data.liked ? parseInt(likeCountSpan
                                .textContent) + 1 : parseInt(likeCountSpan.textContent) - 1;
                        });
                });
            });

            // Handle Reply Form Toggle
            document.querySelectorAll(".reply-btn").forEach(button => {
                button.addEventListener("click", function() {
                    let commentId = this.getAttribute("data-comment-id");
                    document.querySelector(`.reply-form[data-comment-id="${commentId}"]`).style
                        .display = "block";
                });
            });

            // Handle Reply Submission
            document.querySelectorAll(".reply-form").forEach(form => {
                form.addEventListener("submit", function(event) {
                    event.preventDefault();

                    let commentId = this.getAttribute("data-comment-id");
                    let replyInput = this.querySelector(".reply-input");
                    let repliesContainer = this.closest(".comment-holder").querySelector(
                        ".replies");

                    fetch(`/comment/${commentId}/reply`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                reply_text: replyInput.value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            let newReply = document.createElement("div");
                            newReply.classList.add("reply");
                            newReply.innerHTML = `
                                        <span class="user-icon"><i class="fi fi-rr-user"></i></span>
                                        <div class="reply-content">
                                            <h6>${data.reply.user.name}</h6>
                                            <p>${data.reply.texte}</p>
                                            <span class="text-muted">${data.reply.date_commentaire}</span>
                                        </div>`;
                            repliesContainer.appendChild(newReply);
                            replyInput.value = "";
                        });
                });
            });
        });

        function likeDebate(debatId, choice, userId) {
            if (!userId) {
                showToast('Veullez vous connecter pour voter', 'warning')
            }
            fetch(`/debats/${debatId}/votes`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id_user: userId,
                        id_debat: debatId,
                        choix: choice
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.vote) {
                        const likeIcon = document.querySelector(`#likeIcon`);
                        const likeCountElement = document.getElementById(`like-count-${debatId}`);


                        // Update the color and count
                        likeIcon.classList.remove('fi-rr-heart')
                        likeIcon.classList.add('fi-sr-heart')
                        likeIcon.classList.add('text-primary')
                        // likeIcon.style.color = 'blue'; // Change icon color to red
                        const currentLikes = parseInt(likeCountElement.textContent) || 0;
                        likeCountElement.textContent = currentLikes + 1;
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <script src="{{ asset('/build/assets/app-BxeXCBDj.js') }}"></script>
    <!-- typing script -->

    <script>
        Pusher.logToConsole = true;

        document.getElementById('toggleFullscreenBtn').addEventListener('click', function() {
            const chatSection = document.getElementById('chat-section-holder');

            // Toggle the fullscreen class
            chatSection.classList.toggle('fullscreen');

            // Optionally, change the button text based on the state
            // const isFullscreen = chatSection.classList.contains('fullscreen');
            // this.textContent = isFullscreen ? 'Exit Fullscreen' : 'Go Fullscreen';

            // Change the icon and tooltip
            const isFullscreen = chatSection.classList.contains('fullscreen');
            toggleIcon.className = isFullscreen ? 'fas fa-compress' : 'fas fa-expand'; // Change icon
            this.setAttribute('title', isFullscreen ? 'Minimiser' : 'Maximiser -plein écran');
        });


        let typingTimer; // Timer variable
        const typingTimeout = 2000; // Timeout duration in milliseconds
        const postCardIds = '{{ $debat->id_debat }}';
        const messageInput = document.querySelector('textarea[name="texte"]');
        const messagesContainers = document.getElementById('chat-section');

        // When the user types in the message input, trigger the typing event
        // Timer to control typing detection
        let typingBubbleId = 'typing-bubble'; // ID for the typing bubble element
        const typingDelay = 500;

        // Event listener for message input
        messageInput.addEventListener('input', (e) => {
            clearTimeout(typingTimer); // Clear the previous timeout if any

            // Set a new timeout to trigger the typing event after the user stops typing for `typingDelay` ms
            typingTimer = setTimeout(() => {
                // Broadcast the typing event to the server
                axios.get(`{{ route('typing.broadcast', $debat->id_debat) }}`, {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                });

                console.log("Typing event broadcasted");
            }, typingDelay);
            removeTypingBubble();
        });

        // Listen for the typing event using Laravel Echo
        window.Echo.channel(`chatType.${postCardIds}`)
            .listen('Typing', (e) => {
                console.log('Typing event received:', e);

                // Only show the typing bubble if the user is not typing themselves
                const isTyping = e.id_user !== parseInt("{{ auth()->id() }}");

                const typingBubble = document.getElementById(typingBubbleId);

                if (isTyping) {
                    // Show the typing bubble when another user is typing
                    if (!typingBubble) {
                        const typingElement = document.createElement('div');
                        typingElement.id = typingBubbleId;
                        typingElement.classList.add('d-flex', 'justify-content-center', 'my-3');
                        typingElement.innerHTML = `
                                        <p class="small text-muted mb-4">
                                            <em>${e.user_name} is typing...</em>
                                        </p>
                                    `;
                        document.getElementById("chat-section").appendChild(typingElement);
                    } else {
                        typingBubble.style.display = "block";
                        document.getElementById('type_text').textContent = `${e.user_name} écrit...`;
                        typingTimer = setTimeout(() => {
                            removeTypingBubble(); // Remove typing indicator if no typing
                        }, 3000);
                        // Ensure it's visible if it already exists
                    }
                } else {
                    // Remove the typing bubble when the user stops typing or if it's their own typing
                    removeTypingBubble();
                }
            })
            .error((error) => {
                console.error('Error subscribing to channel:', error);
            });

        // Function to remove the typing bubble
        function removeTypingBubble() {
            const typingBubble = document.getElementById(typingBubbleId);
            if (typingBubble) {
                typingBubble.style.display = 'none'; // Hide the bubble
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.13.0/dist/echo.iife.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@4.6.2/dist/index.min.js"></script>



    <script>
        // Include Emoji Button library
        // Initialize Emoji Picker
        // const picker = new EmojiButton();

        // picker.on('emoji', emoji => {
        //     const textarea = document.querySelector('textarea[name="texte"]');
        //     textarea.value += emoji;
        // });

        // document.getElementById('emoji-button').addEventListener('click', () => {
        //     picker.togglePicker(document.getElementById('emoji-button'));
        // });


        // document.getElementById('camera-button').addEventListener('click', function() {
        //     document.getElementById('photo-upload').click();
        // });

        // document.getElementById('attachment-button').addEventListener('click', function() {
        //     document.getElementById('attachment-upload').click();
        // });

        // document.getElementById('photo-upload').addEventListener('change', function(event) {
        //     const file = event.target.files[0];
        //     if (file) {
        //         const reader = new FileReader();
        //         reader.onload = function(e) {
        //             // Optionally, display the image preview
        //             const imgPreview = document.createElement('img');
        //             imgPreview.src = e.target.result;
        //             imgPreview.style.maxWidth = '100%';
        //             imgPreview.style.marginLeft = '0px';
        //             document.querySelector('.image-preview').appendChild(imgPreview);
        //         };
        //         reader.readAsDataURL(file);
        //     }
        // });



        function shareContent() {
            const shareData = {
                title: 'Check out this debate!',
                text: 'Join the discussion on this interesting topic.',
                url: window.location.href, // Current page URL
            };

            if (navigator.share) {
                // Use the Web Share API if available
                navigator.share(shareData)
                    .then(() => console.log('Content shared successfully'))
                    .catch((error) => console.error('Error sharing:', error));
            } else {
                // Fallback for browsers that don't support navigator.share
                showToast('Sharing is not supported on this browser. Copy the URL to share: ' + shareData.url, 'error');
            }
        }

        document.getElementById('comment-form').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            const id_debat = formData.id_debat
            fetch("{{ route('comments.store', $debat->id_debat) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    showToast(data.message, 'success'); // Notify user
                    location.reload(); // Reload comments
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('message_form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the form from reloading the page

            const messageInput = this.querySelector('textarea[name="texte"]');
            const messageText = messageInput.value.trim();
            // const photoInput = document.getElementById('photo-upload');
            // const photoFile = photoInput.files[0];
            const postCardId = '{{ $debat->id_debat }}';

            // Ensure a message or photo is provided
            if (!messageText && !photoFile) return;

            const formData = new FormData();
            formData.append('texte', messageText);
            // formData.append('photo', photoFile);

            axios.post(`{{ route('messages.store', ['postCard' => $debat->id_debat]) }}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                })
                .then(response => {
                    // Clear the input fields
                    messageInput.value = '';
                    // photoInput.value = '';

                    // Add the new message to the chat UI
                    const message = response.data.message;
                    console.log(message);
                    const isSent = message.id_user === parseInt("{{ auth()->id() }}");
                    const createdAt = new Date(message.created_at);
                    const hours = createdAt.getHours() % 12 || 12;
                    const minutes = String(createdAt.getMinutes()).padStart(2, '0');
                    const amPm = createdAt.getHours() >= 12 ? 'PM' : 'AM';
                    const formattedTime = `${hours}:${minutes} ${amPm}`;

                    const messageElement = document.createElement('div');
                    messageElement.classList.add('d-flex', isSent ? 'flex-row-reverse' : 'flex-row', 'mb-4');
                    messageElement.innerHTML = `
                                <img class="d-none" src="${isSent ? '{{ asset(auth()->user()->profile_image ?? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4-bg.webp') }}' : '{{ asset($message->user->profile_image ?? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3-bg.webp') }}'}"
                                     alt="avatar"  width="30px" height="30px">
                                <div>
                                    <p style="border-radius: 20px;
                                    border-bottom-left-radius: 0;" class="small p-2 ${isSent ? 'me-3 text-white bg-primary' : 'ms-3 bg-body-tertiary'} mb-1 rounded-3">
                                        ${message.texte}
                                    </p>
                                    <p class="small ${isSent ? 'me-3 text-muted' : 'ms-3 text-muted'}">${formattedTime}</p>
                                </div>
                            `;

                    const chatContainer = document.getElementById('chat-section');
                    chatContainer.appendChild(messageElement);
                    chatContainer.scrollTop = chatContainer.scrollHeight; // Auto-scroll to the bottom
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                });
        });

        // Camera button functionality
        // document.querySelector('.fa-camera').addEventListener('click', () => {
        //     document.getElementById('photo-upload').click();
        // });

        // Automatically adjust textarea height
        document.querySelector('textarea[name="texte"]').addEventListener('input', function() {
            this.style.height = 'auto'; // Reset the height
            this.style.height = this.scrollHeight + 'px'; // Adjust to the new height
        });


        // Enable pusher logging - don't include this in production



        const postCardId = '{{ $debat->id_debat }}';
        const messagesContainer = document.getElementById('chat-section');

        //     g(window.Echo.channel(`chat.${postCardId}`));
        // console.lo
        // Listen for the MessageSent event on the private channel

        // Listen for the MessageSent event on the public channel
        window.Echo.channel(`chat.${postCardId}`)
            .listen('MessageSent', (e) => {
                console.log('MessageSent event received:', e);

                // Check if the message is sent by the current user
                const isSent = e.id - user === parseInt("{{ auth()->id() }}");
                const createdAt = new Date(e.created_at);
                const hours = createdAt.getHours() % 12 || 12;
                const minutes = String(createdAt.getMinutes()).padStart(2, '0');
                const amPm = createdAt.getHours() >= 12 ? 'PM' : 'AM';
                const formattedTime = `${hours}:${minutes} ${amPm}`;

                // Only add messages sent by others to the UI
                if (!isSent) {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('d-flex', 'flex-row', 'mb-4');
                    messageElement.innerHTML = `
                                    <img  class="d-none" src="${e.id_user === parseInt("{{ auth()->id() }}") ? '{{ asset(auth()->user()->profile_image ?? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4-bg.webp') }}' : '{{ asset($message->user->profile_image ?? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3-bg.webp') }}'}"
                                         alt="avatar" width="30px" height="30px">
                                    <div>
                                        <p style="border-radius: 20px;
                            border-bottom-left-radius: 0;" class="small p-2 ${e.id_user === parseInt("{{ auth()->id() }}") ? 'me-3 text-white bg-primary' : 'ms-3 bg-white'} mb-1 rounded-3">
                                            ${e.texte}
                                        </p>
                                        <p class="small ${e.id_user === parseInt("{{ auth()->id() }}") ? 'me-3 text-muted' : 'ms-3 text-muted'}">${formattedTime}</p>
                                    </div>
                                `;

                    const chatContainer = document.getElementById('chat-section');
                    chatContainer.appendChild(messageElement);
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
            })
            .error((error) => {
                console.error('Error subscribing to channel:', error);
            });

        // window.Echo.private(`chat.${postCardId}`)
        // .listen('.MessageSent', (e) => {
        //     console.log('Message received:', e);
        // })
        // .listenForWhisper('typing', (e) => {
        //     console.log('User is typing:', e);
        // })
        // .error((error) => {
        //     console.error('Subscription error:', error);
        // });


        // Listen for new messages on the private channel
        // console.log(window.Echo.private);
    </script>
@endpush
