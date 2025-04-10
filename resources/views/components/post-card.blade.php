
<style>
    /* General Styles */
    .cards {
        border-radius: 10px;
        border: 0;
        width: 100%;
        height: 200px;
        background-color: #ffffff;
    }

    .post-cards {
        display: flex;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .imageSection {
        width: 30%;
        height: 100%;
        background-clip: initial;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    .badge {
        font-size: 0.8rem;
        border-radius: 20px;
        opacity: 0.9;
        margin-bottom: 5px;
        width: 70%;
    }

    .content-details {
        width: 70%;
        height: 100%;
        padding: 10px;
    }

    .badge.bg-primary {
        font-size: 0.85rem;
    }

    .text-muted {
        font-size: 0.9rem;
    }

    .card-title {
        font-weight: bold;
        color: #2c3e50;
        font-size: 1rem;
        max-width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .action-section {
        display: flex;
        align-items: center;
        padding: 10px;
        gap: 70px;
    }

    .icon-with-badge {
        position: relative;
        display: flex;
        align-items: center;
    }

    .icon-with-badge i {
        font-size: 1.4rem;
        margin-left: 10px;
    }

    .badge-rounded-circle {
        position: absolute;
        top: 0;
        start: 100%;
        transform: translate(-50%, -50%);
        background: white;
        border-radius: 50%;
    }

    /* Mobile Styles */
    @media (max-width: 768px) {
        .cards {
            height: auto;
        }

        .post-cards {
            flex-direction: column;
        }

        .imageSection {
            width: 100%;
            height: 150px;
            display: flex;
            flex-direction: column;
            /* padding: 20px; */
            justify-content: end;
        }
        .badge{
            max-width: 60%;
            opacity: 0.7;
        }

        .content-details {
            width: 100%;
        }

        .action-section {
            gap: 20px;
            justify-content: space-between;
        }

        .icon-with-badge i {
            font-size: 1.2rem;
        }

        .badge {
            font-size: 0.7rem;
            width: auto;
        }
    }
    </style>

    <a href="debat/{{ $id }}" class="" style="text-decoration: none;">
        <div class="card border-0">
            <div class="post-cards shadow d-flex">
                <div class="imageSection bg-default" style="background-image: url('{{ asset('storage/' . $image) }}');">
                    <span class="badge position-relative bottom-10 start-50 translate-middle-x
                        {{ $status == 'Validé' ? 'bg-success' : ($status == 'En attente' ? 'bg-warning' : 'bg-danger') }}">
                        {{ $status }}
                    </span>
                </div>
                <div class="content-details p-2">
                    <div class="col-md-8 d-flex w-100 flex-column">
                        <div>
                            <span class="badge bg-primary px-3 py-1">
                                {{ strtoupper(str_replace('_', ' ', $category)) }}
                            </span>
                            <small class="text-muted d-block mt-1">
                                {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}
                            </small>
                        </div>
                        <h5 class="card-title text-truncate">{{ $title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($description, 70, '...') }}</p>
                    </div>
                    <div class="d-flex action-section align-items-center p-3 mt-0">
                        <div class="icon-with-badge position-relative d-flex align-items-center">
                            <i class="fi fi-rr-messages text-dark"></i>
                            <span class="badge position-absolute top-0 start-100 translate-middle badge-rounded-circle bg-white">
                                {{ $comments }}
                            </span>
                        </div>
                        <div class="icon-with-badge position-relative d-flex align-items-center">
                            <i class="fi fi-rr-heart text-dark"></i>
                            <span class="badge ms-1 position-absolute top-0 start-100 translate-middle badge-rounded-circle bg-white">
                                {{ $likes }}
                            </span>
                        </div>
                        <div class="icon-with-badge d-flex align-items-center" onclick="openShareModal(event, 'debat/{{ $id }}')">
                            <i class="fi fi-rr-share text-dark"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>

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
                        <button class="btn btn-primary">Facebook</button>
                        <button class="btn btn-info">LinkedIn</button>
                        <button class="btn btn-success">WhatsApp</button>
                        <button class="btn btn-dark">Instagram</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script>
    // Function to open the share modal and prevent navigation
    function openShareModal(event, url) {
        event.preventDefault(); // Prevent the default link behavior
        const link = document.getElementById('shareLink'); // Store the link element

        // Open the share modal (Bootstrap modal)
        var myModal = new bootstrap.Modal(document.getElementById('shareModal'));
        myModal.show();

        // Store the link so it can be opened after sharing
        sessionStorage.setItem('shareLink', 'debat/{{ $id }}'); // Store the URL for later
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
    function shareContent() {
        const shareData = {
            title: 'Check out this debate!',
            text: 'Join the discussion on this interesting topic.',
            url: `http://localhost:8000/debat/{{ $id }}`, // Current page URL
        };

        if (navigator.share) {
            // Use the Web Share API if available
            navigator.share(shareData)
                .then(() => console.log('Content shared successfully'))
                .catch((error) => console.error('Error sharing:', error));
        } else {
            // Fallback for browsers that don't support navigator.share
            alert('Sharing is not supported on this browser. Copy the URL to share: ' + shareData.url);
        }
    }
</script>
