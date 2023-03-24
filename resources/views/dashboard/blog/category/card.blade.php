<div class="card">
    <div class="card-body">
       
        <div class="row">
            <div class="col">
                <p class="m-0 mb-1 h6">{{ $category->name }}</p>
                <p class="small text-muted m-0">
                    <i class="fa fa-fw fa-thumbtack"></i> {{ $category->posts_count }} posts
                </p>
                <p class="small text-muted m-0">
                    <i class="fa fa-fw fa-eye"></i> {{ $category->views_count }} visualizações
                </p>
            </div>
            <div class="col-auto">
                <div class="dropdown">
                    <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-fw fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu fs-7 shadow-sm" aria-labelledby="dropdownMenuButton1">
                        
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard.blog.category.edit', $category) }}">
                                <i class="fa fa-fw fa-edit"></i> Editar
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard.blog.category.destroy', $category) }}" data-bs-toggle="modal" data-bs-target="#remove-modal">
                                <i class="fa fa-fw fa-trash"></i> Excluir
                            </a>
                        </li>

                        
                    </ul>
                  </div>
            </div>
        </div>
    
    </div>
</div>