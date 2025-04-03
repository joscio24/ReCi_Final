<li class="mb-2 ">
    <a href="/debat/{{$id}}" class="rec-posts">
        <div class="rec-posts-image" style="background-image: url('{{ Storage::url($image) }}');"></div>
        <div class="rec-posts-details">
            <h5>{{ Str::limit($title, 50, '...') }}</h5>
            <p>{{ Str::limit($description, 50, '...') }}</p>
            <div class="d-flex rec-post-tag">
                <span class="badge bg-primary">{{ strtoupper(str_replace('_', ' ', $category)) }} </span>
                <small>
                    {{ $date }}
                </small>

            </div>
        </div>
    </a>
</li>
