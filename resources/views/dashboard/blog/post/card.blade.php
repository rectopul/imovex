<div class="card">
    <div class="card-body">
        <div class="row">
            @if(strpos($post->cover, '.') !== false)
            <div class="col-2">
                <img src="{{ $post->cover }}" alt="" class="img-fluid">
            </div>
            @endif
            <div class="col">
                <div class="row">
                    <div class="col">
                        
                        <p class="m-0 fs-5">
                            {{ $post->title }}
                            <span class="badge bg-{{ $post->status_color }} small" style="font-size: 0.8rem;">
                                {{ $post->status }}
                            </span>
                            @if($post->highlight)
                                <span class="badge bg-warning small text-dark" style="font-size: 0.8rem;">
                                    <i class="fa fa-fw fa-star"></i>
                                    Destaque
                                </span>
                            @endif
                            @if($post->at_home)
                                <span class="badge bg-info small text-white" style="font-size: 0.8rem;">
                                    <i class="fa fa-fw fa-home"></i>
                                    Home
                                </span>
                            @endif
                        </p>

                        <p class="text-muted mt-0 small">
                            <i class="fa fa-fw fa-user"></i> {{ $post->user->name }}
                        </p>
                        
                        @if($post->publish)
                            <p class="text-muted m-0 small">
                                <i class="fa fa-fw fa-calendar"></i> {{ $post->publish }} 
                                @if($post->status === 'Publicado')
                                    <i class="ms-2 fa fa-fw fa-comments"></i> {{ $post->comments_count }} comentários
                                    <i class="ms-2 fa fa-fw fa-eye"></i> {{ $post->views_count }} visualizações
                                @endif
                            </p>
                        @endif

                        @if($post->categories)
                        <p class="mt-2">
                            @foreach($post->categories as $category)
                                <span class="badge bg-light text-dark">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </p>
                        @endif
                        
                        @if($post->description != 'null')
                            <p class="small">{{ $post->description }}</p>
                        @endif

                    </div>
                    <div class="col-auto">
                        <div class="dropdown">
                            <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-fw fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu fs-7 shadow-sm" aria-labelledby="dropdownMenuButton1">
                                @if($post->status === 'Publicado')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('web.blog.post.show', $post) }}" target="_blank">
                                            <i class="fa fa-fw fa-eye"></i> Visualizar
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.blog.post.edit', $post) }}">
                                        <i class="fa fa-fw fa-edit"></i> Editar
                                    </a>
                                </li>

                                @if(!$post->highlight)
                                    <li>
                                        <a class="dropdown-item publish-post" href="{{ route('dashboard.blog.post.publish.update', $post) }}">
                                            @if($post->publish)
                                                <i class="fa fa-fw fa-eye-slash"></i> Cancelar {{ $post->status === 'Publicado' ? 'publicação' : 'agendamento' }}
                                            @else
                                                <i class="fa fa-fw fa-check"></i> Publicar agora
                                            @endif
                                            
                                        </a>
                                    </li>
                                @endif

                                @if(!$post->highlight && $post->status === 'Publicado')
                                    <li>
                                        <a class="dropdown-item publish-post" href="{{ route('dashboard.blog.post.highlight.update', $post) }}">
                                            <i class="fa fa-fw fa-star"></i> Destaque
                                        </a>
                                    </li>
                                @endif

                                @if($post->publish)
                                    @if($post->at_home)
                                        <li>
                                            <a class="dropdown-item home-post" href="{{ route('dashboard.blog.post.at_home', $post) }}">
                                                <i class="fa fa-fw fa-times"></i> Remover da Home
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item home-post" href="{{ route('dashboard.blog.post.at_home', $post) }}">
                                                <i class="fa fa-fw fa-home"></i> Exibir na Home
                                            </a>
                                        </li>
                                    @endif
                                @endif

                                @if(!$post->highlight)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard.blog.post.destroy', $post) }}" data-bs-toggle="modal" data-bs-target="#remove-modal">
                                            <i class="fa fa-fw fa-trash"></i> Remover
                                        </a>
                                    </li>
                                @endif
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>