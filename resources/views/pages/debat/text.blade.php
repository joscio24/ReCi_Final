<section id="comments" class="mt-4">

    <div class="row  mb-2">
        <!-- Left Column: "For" Comments -->
        <div class="col-md-6">
            <h3
                class="text-success fw-bold text-uppercase text-center display-7 mb-4 position-relative d-inline-block">
                <span class="border-bottom border-3 border-success pb-1">Pour</span>
            </h3>
            <div class="comment-section card "
                style="overflow: scroll; scrollbar-width: none; {{ count($forComments) >= 0 ? 'height: 400px;' : 'height: 100px;' }} ">

                @if (count($forComments) > 0)
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
                                    @auth
                                        <button class="reply-btn btn btn-sm btn-primary"
                                            data-comment-id="{{ $comment->id_commentaire }}">
                                            Répondre
                                        </button>
                                    @endauth

                                    <!-- Reply Form (Hidden by Default) -->
                                    <form class="reply-form p-3 rounded border shadow-sm mt-2"
                                        data-comment-id="{{ $comment->id_commentaire }}"
                                        style="display: none; background-color: #f9f9f9;">
                                        @csrf
                                        <div class="mb-2">
                                            <input type="text" class="form-control reply-input w-100"
                                                name="reply_text" placeholder="Votre réponse..."
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="bi bi-send"></i> Envoyer
                                        </button>
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
            <h3
                class="text-danger fw-bold text-uppercase text-center display-7 mb-4 position-relative d-inline-block">
                <span class="border-bottom border-3 border-danger pb-1">Contre</span>
            </h3>

            <div class="comment-section card "
                style="overflow: scroll; scrollbar-width: none; {{ count($forComments) >= 0 ? 'height: 400px;' : 'height: 100px;' }} ;">
                @if (count($againstComments) > 0)
                    @php

                        function renderReplies($replies)
                        {
                            foreach ($replies as $reply) {
                                echo '<div class="d-flex w-100">';
                                echo '<div class="reply-line"></div>';
                                echo '<div class="reply mt-2">';
                                echo '<div class="reply-box">';
                                echo '<span class="user-icon"><i class="fi fi-rr-user"></i></span>';
                                echo '<div class="reply-content">';
                                echo '<h6 class="username">' . $reply->user->name . '</h6>';
                                echo '<p class="comment-message">' . $reply->texte . '</p>';
                                echo '<span class="text-muted date">' .
                                    $reply->date_commentaire .
                                    '</span>';

                                if (auth()->check()) {
                                    $replyId = $reply->id_commentaire;
                                    $replyCount = $reply->replies->count();
                                    $label =
                                        "Voir {$replyCount} réponse" . ($replyCount > 1 ? 's' : '');

                                    echo '
                                        <button class="reply-btn btn btn-sm btn-outline-secondary mt-1" data-comment-id="' .
                                        $replyId .
                                        '">
                                            Répondre
                                        </button>
                                        <button class="reply-btn toggle-replies-rep-btn btn btn-link p-0 mt-2" data-target="#replies-' .
                                        $replyId .
                                        '">
                                            ' .
                                        $label .
                                        '
                                        </button>
                                    ';
                                    echo '<form class="reply-form p-2 rounded border shadow-sm mt-2" data-comment-id="' .
                                        $reply->id_commentaire .
                                        '" style="display: none; background-color: #f5f5f5;">';
                                    echo csrf_field();
                                    echo '<div class="mb-2">';
                                    echo '<input type="text" class="form-control reply-input w-100" name="reply_text" placeholder="Votre réponse..." required>';
                                    echo '</div>';
                                    echo '<button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-send"></i> Envoyer</button>';
                                    echo '</form>';
                                }

                                echo '</div></div></div></div>';

                                if ($reply->replies->count()) {
                                    $replyId = $reply->id_commentaire;
                                    echo '<div class="replies collapse" id="replies-' .
                                        $replyId .
                                        '" data-target="replies-' .
                                        $replyId .
                                        '">';
                                    renderReplies($reply->replies);
                                    echo '</div>';
                                }
                            }
                        }
                    @endphp

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
                                    @auth
                                        <button class="reply-btn btn btn-sm btn-primary"
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

                                    <!-- Reply Form (Hidden by Default) -->


                                    <form class="reply-form p-3 rounded border shadow-sm mt-2"
                                        data-comment-id="{{ $comment->id_commentaire }}"
                                        style="display: none; background-color: #f9f9f9;">
                                        @csrf
                                        <div class="mb-2">
                                            <input type="text"
                                                class="form-control reply-input w-100"
                                                name="reply_text" placeholder="Votre réponse..."
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="bi bi-send"></i> Envoyer
                                        </button>
                                    </form>

                                </div>
                            </div>

                            <!-- Replies Section -->
                            <div id="replies-{{ $comment->id_commentaire }}"
                                class="replies collapse  {{ count($comment->replies) < 2 ? 'no-border' : '' }}">
                                @php renderReplies($comment->replies); @endphp
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
