<div class="card">
    <div class="card-body">
       
        <div class="border-start border-5 border-{{ $comment->status_class }} ps-3">
            <div class="row">
                <div class="col">
                    <p class="fw-bold">{{ $comment->post->title }}</p>
                </div>
                <div class="col-auto">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-{{ $comment->status_class }} dropdown-toggle" type="button" id="dropdownMenu{{ $comment->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $comment->status_text }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="dropdownMenu{{ $comment->id }}">
                            @if($comment->status != 'AP')
                                <li><a class="moderate-comment dropdown-item" href="{{ route('dashboard.blog.post.comment.moderate.update', [$comment, 'AP']) }}">APROVAR</a></li>
                            @endif
                            {{-- @if($comment->status != 'SP')
                                <li><a class="moderate-comment dropdown-item" href="{{ route('dashboard.blog.post.comment.moderate.update', [$comment, 'SP']) }}">SPAM</a></li>
                            @endif --}}
                            @if($comment->status != 'BL')
                                <li><a class="moderate-comment dropdown-item" href="{{ route('dashboard.blog.post.comment.moderate.update', [$comment, 'BL']) }}">BLOQUEAR</a></li>
                            @endif
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#remove-modal" href="{{ route('dashboard.blog.post.comment.destroy', $comment) }}">EXCLUIR</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <p class="m-0"><span class="fw-bold">{{ $comment->name }}</span> <span class="ms-1 text-muted small">{{ $comment->created_at->diffForHumans() }}</span></p>
            <p class="m-0 text-dark">{{ $comment->body }}</p>
        </div>
    
    </div>
</div>