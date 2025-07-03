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
            margin-right: 1px;
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
            color: rgb(0, 81, 255);
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
            width: 100%;
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


        h3.text-danger {
            letter-spacing: 2px;
        }

        h3.text-danger::after {
            content: '';
            display: block;
            height: 4px;
            width: 60%;
            background-color: crimson;
            margin: 0 auto;
            margin-top: 5px;
            border-radius: 2px;
        }

        h3.text-dark::after {
            content: ' ';
            display: block;
            height: 4px;
            width: 60%;
            background-color: #050505;
            margin: 0 auto;
            margin-top: 5px;
            border-radius: 2px;
        }

        h3.text-success {
            letter-spacing: 2px;
        }

        h3.text-success::after {
            content: '';
            display: block;
            height: 4px;
            width: 60%;
            background-color: rgb(7, 177, 58);
            margin: 0 auto;
            margin-top: 5px;
            border-radius: 2px;
        }


        .comment-holder {
            margin-bottom: 16px !important;
            padding: 8px 0 !important;
            border-bottom: 1px solid #ddd !important;
        }

        .comment {
            display: flex !important;
            align-items: flex-start !important;
        }

        .user-icon {
            font-size: 20px !important;
            color: #ffffff !important;
            margin-right: 1px !important;
        }

        .comment-content,
        .reply-content {
            background-color: #f0f2f5 !important;
            border-radius: 18px !important;
            padding: 10px 16px !important;
            max-width: 100% !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
        }

        .username {
            font-weight: bold !important;
            font-size: 14px !important;
            margin-bottom: 4px !important;
        }

        .comment-message {
            font-size: 14px !important;
            color: #050505 !important;
            margin: 4px 0 !important;
        }

        .date {
            font-size: 12px !important;
            color: #65676b !important;
        }

        .like-btn,
        .reply-btn,
        .toggle-replies-btn {
            font-size: 13px !important;
            background: none !important;
            border: none !important;
            color: #65676b !important;
            padding: 4px 0 !important;
            cursor: pointer !important;
        }

        .like-btn i {
            color: #287bf0 !important;
        }

        .like-btn:hover,
        .reply-btn:hover,
        .toggle-replies-btn:hover {
            color: #1877f2 !important;
            text-decoration: underline !important;
        }

        .reply-form {
            margin-top: 8px !important;
            background-color: #fff !important;
            border-radius: 12px !important;
            border: 1px solid #ccc !important;
            padding: 10px !important;
        }

        .replies {
            margin-left: 48px !important;
            margin-top: 12px !important;
            padding-left: 10px !important;
            border-left: 2px solid #e4e6eb !important;
        }

        .reply-box {
            display: flex !important;
            align-items: flex-start !important;
            margin-top: 10px !important;
        }

        .toggle-replies-btn {
            font-weight: 500 !important;
            color: #1877f2 !important;
            font-size: 13px !important;
            margin-top: 6px !important;
        }

        .reply-line {
            width: 20px !important;
            border-left: 2px solid #e4e6eb !important;
            margin-right: 8px !important;
        }

        .border-underline {
            border-bottom: 3px solid #011326;
            /* You can change the color */
            display: inline-block;
            padding-bottom: 4px;
            margin-bottom: 3rem;
            /* Adjust spacing from text to underline */
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
                        <p class=" mt-4">{{ $debat->description }}</p>

                    </div>

                    <div class="card p-2">
                        <div class="row align-items-center">

                            <p>
                                Proposé par: <strong>{{ $debat->user->name }}</strong> |
                                {{ \Carbon\Carbon::parse($debat->created_at)->translatedFormat('d F Y') }}
                            </p>

                            <!-- Vote icon -->
                            {{-- <div class="col-auto m-1">
                                <div class="icon-with-badge d-flex align-items-center justify-content-center">
                                    <span class="me-3 d-icon" style="cursor: pointer;">
                                        <i id="likeIcon"
                                            class="fi like-button {{ $userHasVoted ? 'fi-sr-heart text-primary' : 'fi-rr-heart' }}"
                                            onclick="likeDebate({{ $debat->id_debat }}, true, {{ auth()->id() }});"></i>
                                    </span>
                                    <span class="badge like-count" id="like-count-{{ $debat->id_debat }}">
                                        {{ $debat->votes_count }}
                                    </span>
                                </div>
                            </div> --}}


                            <div class="col-auto">
                                <button type="button" class="btn btn- position-relative"
                                    style="background-color: #d6d9de;">
                                    <i id=""
                                        class="fi like-button {{ $userHasVoted ? 'fi-sr-heart text-primary' : 'fi-rr-heart' }}"
                                        onclick="likeDebate({{ $debat->id_debat }}, true, {{ auth()->id() }});"></i>
                                    {{ $userHasVoted ? 'J\'aime déjà' : 'Like(s)' }}
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary"
                                        id="like-count-{{ $debat->id_debat }}">
                                        {{ $debat->votes_count }}
                                    </span>
                                </button>
                            </div>

                            <!-- Comment Count Button -->

                            <div class="col-auto">
                                <button type="button" class="btn btn- position-relative"
                                    style="background-color: #d6d9de;">
                                    <i class="fi fi-rr-messages "></i> Commentaire(s)
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                        {{ $debat->commentaires_count }}
                                    </span>
                                </button>
                            </div>

                            <!-- Share Icon -->
                            <div class="col-auto">
                                <button class="btn text-center d-flex align-items-center" onclick="openShareModal()"
                                    style="background-color: #d6d9de;">
                                    <i class="fi fi-rr-share me-1"></i>
                                    Partager
                                </button>
                            </div>

                            <!-- Like / Dislike Buttons -->
                            <div class="col-auto {{ $userHasVoted }} mb-2">
                                <div class="d-flex align-items-center mt-2" style="gap: 20px;">
                                    <!-- "Pour" (Like) Button -->
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-default d-flex align-items-center"
                                            style="background-color: #d6d9de;"
                                            onclick="likeDebate({{ $debat->id_debat }}, true, {{ auth()->id() }});">
                                            <i class="fas fa-thumbs-up m-1"></i>
                                        </button>
                                        <span class="vote-count-box" id="like-count-{{ $debat->id_debat }}">
                                            {{ $likesCount }}
                                        </span>
                                    </div>

                                    <!-- "Contre" (Dislike) Button -->
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-default d-flex align-items-center"
                                            style="background-color: #d6d9de;"
                                            onclick="likeDebate({{ $debat->id_debat }}, false, {{ auth()->id() }});">
                                            <i class="fas fa-thumbs-down m-1"></i>
                                        </button>
                                        <span hidden class="vote-count-box" id="dislike-count-{{ $debat->id_debat }}">
                                            {{ $dislikesCount ?? 0 }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>





                    <!-- /images{{ $debat->image }} -->

                </article>
                <!-- Comment Section -->
                <section id="comments" class="mt-4">

                    <h3
                        class="text-dark fw-bold text-uppercase text-center display-7 mb-4 position-relative d-inline-block">
                        <span class="border-bottom border-3 border-dark pb-1">Commentaires</span>
                    </h3>

                    <section id="comments" class="mt-4">
                        <div class="row mb-2">
                            <!-- Left Column: "For" Comments -->

                            @php
                                function renderReplies1($replies)
                                {
                                    foreach ($replies as $reply) {
                                        echo '<div class="d-flex w-100">';
                                        echo '<div class="reply-line"></div>';
                                        echo '<div class="reply mt-2">';
                                        echo '<div class="reply-box">';
                                        echo '<span class="user-icon"><i class="fi fi-rr-user"></i></span>';
                                        echo '<div class="reply-content">';
                                        echo '<h6 class="username">' . htmlspecialchars($reply->user->name) . '</h6>';
                                        echo '<p class="comment-message">' . htmlspecialchars($reply->texte) . '</p>';
                                        echo '<span class="text-muted date">' .
                                            htmlspecialchars($reply->date_commentaire) .
                                            '</span>';

                                        $replyId = $reply->id_commentaire;
                                        if (auth()->check()) {
                                            $replyCount = $reply->replies->count();
                                            $label = "Voir {$replyCount} réponse" . ($replyCount > 1 ? 's' : '');

                                            echo '<button class="reply-btn btn btn-sm d-flex justify-content-start border-none mt-1" data-comment-id="' .
                                                $replyId .
                                                '">Répondre</button>';

                                            if ($replyCount > 0) {
                                                echo '<button class="reply-btn toggle-replies-rep-btn btn btn-link p-0 mt-2" data-target="#replies-' .
                                                    $replyId .
                                                    '">' .
                                                    $label .
                                                    '</button>';
                                            }
                                        }

                                        echo '</div>'; // close reply-content
                                        echo '</div>'; // close reply-box
                                        echo '</div>'; // close reply mt-2
                                        echo '</div>'; // close d-flex w-100

                                        echo '<form class="reply-form p-2 rounded border shadow-sm mt-2" data-comment-id="' .
                                            $replyId .
                                            '" style="display: none; background-color: #f5f5f5;">';
                                        echo csrf_field();
                                        echo '<div class="mb-2">';
                                        echo '<input type="text" class="form-control reply-input w-100" name="reply_text" placeholder="Votre réponse..." required>';
                                        echo '</div>';
                                        echo '<button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-send"></i> Envoyer</button>';
                                        echo '</form>';
                                        if ($reply->replies->count()) {
                                            $replyId = $reply->id_commentaire;
                                            echo '<div class="replies collapse" id="replies-' .
                                                $replyId .
                                                '" data-target="replies-' .
                                                $replyId .
                                                '">';
                                            renderReplies1($reply->replies);
                                            echo '</div>';
                                        }
                                    }
                                }
                            @endphp

                            <div class="col-md-12">
                                {{-- <h3 hidden
                                    class="text-success fw-bold text-uppercase text-center display-7 mb-4 position-relative d-inline-block">
                                    <span class="border-bottom border-3 border-success pb-1">Pour</span>
                                </h3> --}}

                                <div class="comment-section card"
                                    style="overflow: auto !important; scrollbar-width: none !important; {{ count($forComments) > 0 ? 'height: 600px !important;' : 'height: 100px !important;' }}">
                                    @if (count($forComments) > 0)
                                        @foreach ($forComments as $comment)
                                            <div class="comment-holder p-3 border-bottom">
                                                <div class="comment d-flex">
                                                    <span class="user-icon me-3">
                                                        <i class="fi fi-rr-user fs-4"></i>
                                                    </span>
                                                    <div class="comment-content">
                                                        <h5 class="username mb-1">{{ $comment->user->name }}</h5>
                                                        <p class="comment-message mb-1">{{ $comment->texte }}</p>
                                                        <span
                                                            class="text-muted date d-block mb-2">{{ $comment->date_commentaire }}</span>

                                                        <div class="d-flex justify-content-between">
                                                            @php
                                                                $isGuest = auth()->guest();
                                                            @endphp
                                                            <button
                                                                @if ($isGuest) disabled title="Connectez-vous pour réagir" @endif
                                                                class="like-btn btn btn-sm btn-outline-primary me-2"
                                                                data-comment-id="{{ $comment->id_commentaire }}">
                                                                <i class="fa fa-thumbs-up"></i> <span
                                                                    class="like-count">{{ $comment->likes->count() }}</span>
                                                            </button>

                                                            <button
                                                                @if ($isGuest) disabled title="Connectez-vous pour réagir" @endif
                                                                class="like-bt unlike-2 btn btn-sm  me-2"
                                                                data-comment-id="{{ $comment->id_commentaire }}">
                                                                <i class="fa fa-thumbs-down"></i> <span
                                                                    class="unlike-count">{{ $comment->unlikes->count() }}</span>
                                                            </button>
                                                        </div>

                                                        @auth
                                                            <button class="reply-btn btn btn-sm btn-outline-primary me-2"
                                                                data-comment-id="{{ $comment->id_commentaire }}">
                                                                Répondre
                                                            </button>
                                                            @if ($comment->replies->count() > 0)
                                                                <button
                                                                    class="toggle-replies-btn reply-btn btn btn-link p-0 m-1"
                                                                    data-target="#replies-{{ $comment->id_commentaire }}">
                                                                    Voir {{ $comment->replies->count() }}
                                                                    réponse{{ $comment->replies->count() > 1 ? 's' : '' }}
                                                                </button>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                </div>

                                                <form class="reply-form p-3 rounded border shadow-sm mt-2"
                                                    data-comment-id="{{ $comment->id_commentaire }}"
                                                    style="display: none !important; background-color: #f9f9f9 !important;">
                                                    @csrf
                                                    <div class="mb-2">
                                                        <input type="text" class="form-control reply-input w-100"
                                                            name="reply_text" placeholder="Votre réponse..." required>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="bi bi-send"></i> Envoyer
                                                    </button>
                                                </form>

                                                <div id="replies-{{ $comment->id_commentaire }}"
                                                    class="replies collapse  {{ count($comment->replies) < 2 ? 'no-border' : '' }}">
                                                    @php renderReplies1($comment->replies); @endphp
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center h-100 w-100 d-flex"
                                            style="flex-direction: column !important; justify-content: center !important;">
                                            <p>Aucun commentaire</p>
                                        </div>
                                    @endif
                                </div>
                            </div>




                        </div>
                    </section>





                    <form id="comment-form" class="card container p-2">
                        @csrf
                        <h4>Je donne mon avis</h4>
                        <input type="hidden" name="id_debat" value="{{ $debat->id_debat }}">

                        {{-- Hidden input for user's vote status --}}
                        @if (isset($userHasVoted) && $userHasVoted)
                            <input type="hidden" name="user_vote" value="true" />
                        @else
                            <input type="hidden" name="user_vote" value="false" />
                        @endif

                        @guest
                            <div class="mb-3">
                                <label for="comment-name" class="form-label">Nom</label>
                                <input type="text" name="name" class="form-control" placeholder="Nom et Prénom"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="comment-email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                        @endguest
                        <div class="mb-3">
                            <label for="comment-content" class="form-label">Commentaire</label>
                            <div class="position-relative">
                                <textarea id="comment-content" name="content" class="form-control" rows="4" placeholder="Votre commentaire"
                                    required data-bs-toggle="tooltip" data-bs-placement="top"></textarea>

                                <small id="hashword-warning" class="text-danger mt-1 d-none">
                                    ⚠️ Des mots interdits ont été détectés.
                                </small>
                            </div>
                        </div>
                        <button type="submit" id="send_comment" class="btn btn-primary">Soumettre</button>
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

                                                <textarea name="texte" style="overflow: hidden; resize: none; height: 50px; width:100%; border-radius: 8px;"
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



    {{-- AI control system --}}

    <script>
        let blockedWords = [];

        const textarea = document.getElementById("comment-content");
        const tooltip = new bootstrap.Tooltip(textarea);
        const send_comment = document.getElementById("send_comment");
        tooltip.disable();
        fetch("/blocked_words.json")
            .then(response => response.json())
            .then(data => {
                blockedWords = data.blocked_words;

                // const textarea = document.getElementById("comment-content");
                const warning = document.getElementById("hashword-warning");
                // const tooltip = new bootstrap.Tooltip(textarea);
                tooltip.disable();

                textarea.addEventListener("input", function() {
                    const value = textarea.value.toLowerCase();
                    const hasBlockedWord = blockedWords.some(word => value.includes(word));

                    if (hasBlockedWord) {
                        tooltip.enable();
                        textarea.classList.add("is-invalid");
                        warning.classList.remove("d-none");
                        send_comment.disabled = true;
                        send_comment.style.cursor = 'not-allowed';
                    } else {
                        tooltip.disable();
                        textarea.classList.remove("is-invalid");
                        warning.classList.add("d-none");
                        send_comment.disabled = false;
                    }
                });
            });



        document.addEventListener("DOMContentLoaded", function() {
            const textarea = document.getElementById("comment-content");
            const warning = document.getElementById("hashword-warning");

            // Activer le tooltip Bootstrap
            const tooltip = new bootstrap.Tooltip(textarea);

            textarea.addEventListener("input", function() {
                const value = textarea.value.toLowerCase();
                const hasBlockedWord = blockedWords.some(word => value.includes(word));

                if (hasBlockedWord) {
                    tooltip.enable();
                    textarea.classList.add("is-invalid");
                    warning.classList.remove("d-none");
                } else {
                    tooltip.disable();
                    textarea.classList.remove("is-invalid");
                    warning.classList.add("d-none");
                }
            });

            // Désactiver le tooltip au départ
            tooltip.disable();
        });
    </script>

    {{-- AI control system --}}



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

            //unlike-2
            document.querySelectorAll(".unlike-2").forEach(button => {
                button.addEventListener("click", function() {
                    let commentId = this.getAttribute("data-comment-id");
                    let likeCountSpan = this.querySelector(".unlike-count");

                    fetch(`/comment/${commentId}/unlike`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                "Content-Type": "application/json"
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            likeCountSpan.textContent = data.liked ? (parseInt(likeCountSpan
                                    .textContent)) + 1 : (parseInt(likeCountSpan.textContent)) -
                                1;
                        });
                });
            });


            // Handle Reply Form Toggle
            // document.querySelectorAll(".reply-btn").forEach(button => {
            //     button.addEventListener("click", function() {
            //         let commentId = this.getAttribute("data-comment-id");
            //         document.querySelector(`.reply-form[data-comment-id="${commentId}"]`).style
            //             .display = "block";
            //     });
            // });



            // Optional: handle reply form submissions via AJAX


            // Handle Reply Submission
            document.querySelectorAll(".reply-form").forEach(form => {
                form.addEventListener("submit", function(event) {
                    event.preventDefault();

                    let commentId = this.getAttribute("data-comment-id");
                    let replyInput = this.querySelector(".reply-input");
                    let replyText = replyInput.value.trim();
                    if (!replyText) return;

                    fetch(`/comment/${commentId}/reply`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                reply_text: replyText
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.reply) {
                                alert("Une erreur est survenue.");
                                return;
                            }

                            const reply = data.reply;

                            // Create new reply HTML
                            let newReply = document.createElement("div");
                            newReply.classList.add("d-flex", "w-100");
                            newReply.innerHTML = `
                    <div class="reply-line"></div>
                    <div class="reply mt-2">
                        <div class="reply-box">
                            <span class="user-icon"><i class="fi fi-rr-user"></i></span>
                            <div class="reply-content">
                                <h6 class="username">${reply.user.name}</h6>
                                <p class="comment-message">${reply.texte}</p>
                                <span class="text-muted date">${reply.date_commentaire}</span>

                                <button class="reply-btn btn btn-sm btn-outline-secondary mt-1" data-comment-id="${reply.id_commentaire}">
                                    Répondre
                                </button>

                                <form class="reply-form p-2 rounded border shadow-sm mt-2" data-comment-id="${reply.id_commentaire}" style="display: none; background-color: #f5f5f5;">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                                    <div class="mb-2">
                                        <input type="text" class="form-control reply-input w-100" name="reply_text" placeholder="Votre réponse..." required>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="bi bi-send"></i> Envoyer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                `;

                            // Find or create the .replies container directly under the current comment or reply
                            let container = form.closest(".reply, .comment-holder");
                            let repliesContainer = container.querySelector(".replies");

                            if (!repliesContainer) {
                                repliesContainer = document.createElement("div");
                                repliesContainer.classList.add("replies");
                                container.appendChild(repliesContainer);
                            }

                            repliesContainer.appendChild(newReply);

                            replyInput.value = "";

                            // Reattach submit listener to new form
                            newReply.querySelector(".reply-form").addEventListener("submit",
                                arguments.callee);

                            // Add reply button toggle logic for new reply form
                            const newReplyBtn = newReply.querySelector(".reply-btn");
                            const newReplyForm = newReply.querySelector(".reply-form");
                            newReplyBtn.addEventListener("click", () => {
                                newReplyForm.style.display = newReplyForm.style
                                    .display === "none" ? "block" : "none";
                            });
                        })
                        .catch(error => {
                            console.error("Erreur lors de l'envoi de la réponse:", error);
                        });
                });
            });

            // Toggle reply forms
            document.querySelectorAll(".reply-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    const commentId = this.getAttribute("data-comment-id");
                    const form = document.querySelector(
                        `.reply-form[data-comment-id="${commentId}"]`);
                    if (form) {
                        form.style.display = form.style.display === "none" ? "block" : "none";
                    }
                });
            });


            document.querySelectorAll(".toggle-replies-btn").forEach(button => {
                button.addEventListener("click", function() {
                    const targetId = this.getAttribute("data-target");
                    const repliesContainer = document.querySelector(targetId);
                    const isVisible = repliesContainer.classList.contains("show");

                    if (isVisible) {
                        repliesContainer.classList.remove("show");
                        this.innerText =
                            `Voir ${repliesContainer.children.length} réponse${repliesContainer.children.length > 1 ? 's' : ''}`;
                    } else {
                        repliesContainer.classList.add("show");
                        this.innerText = "Masquer les réponses";
                    }
                });
            });


            document.querySelectorAll(".toggle-replies-rep-btn").forEach(button => {
                button.addEventListener("click", function() {
                    const targetId = this.getAttribute("data-target");
                    const repliesContainer = document.querySelector(targetId);
                    const isVisible = repliesContainer.classList.contains("show");

                    const count = repliesContainer.children.length;
                    if (isVisible) {
                        repliesContainer.classList.remove("show");
                        this.innerText = `Voir ${count} réponse${count > 1 ? 's' : ''}`;
                    } else {
                        repliesContainer.classList.add("show");
                        this.innerText = "Masquer les réponses";
                    }
                });
            });





        });

        // function likeDebate(debatId, choice, userId) {
        //     if (!userId) {
        //         showToast('Veullez vous connecter pour voter', 'warning')
        //     }
        //     fetch(`/debats/${debatId}/votes`, {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             },
        //             body: JSON.stringify({
        //                 id_user: userId,
        //                 id_debat: debatId,
        //                 choix: choice
        //             })
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.vote) {
        //                 const likeIcon = document.querySelector(`#likeIcon`);
        //                 const likeCountElement = document.getElementById(`like-count-${debatId}`);


        //                 // Update the color and count
        //                 likeIcon.classList.remove('fi-rr-heart')
        //                 likeIcon.classList.add('fi-sr-heart')
        //                 likeIcon.classList.add('text-primary')
        //                 // likeIcon.style.color = 'blue'; // Change icon color to red
        //                 const currentLikes = parseInt(likeCountElement.textContent) || 0;
        //                 likeCountElement.textContent = currentLikes + 1;
        //                 window.location.reload();
        //             } else {
        //                 window.location.reload();
        //             }
        //         })
        //         .catch(error => console.error('Error:', error));
        // }



        function likeDebate(debatId, choice, userId) {
            if (!userId) {
                showToast('Veuillez vous connecter pour voter', 'warning');
                window.location.href = '/login';
                return;
            }

            fetch(`/debats/${debatId}/votes`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id_user: userId,
                        choix: choice
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // const likeIcon = document.querySelector(`#likeIcon`);
                    const likeCountElement = document.getElementById(`like-count-${debatId}`);

                    // if (data.vote) {
                    //     // Vote added or updated
                    //     likeIcon.classList.remove('fi-rr-heart');
                    //     likeIcon.classList.add('fi-sr-heart', 'text-primary');
                    // } else {
                    //     // Vote removed
                    //     likeIcon.classList.remove('fi-sr-heart', 'text-primary');
                    //     likeIcon.classList.add('fi-rr-heart');
                    // }

                    // Update likes count
                    likeCountElement.textContent = data.likes_count;

                    // Optionally update dislikes count if you track it in UI

                    showToast(data.message, 'success');
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Erreur lors du vote', 'error');
                });
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
                    // location.reload(); // Reload comments
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
