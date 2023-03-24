<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <p class="card-title fw-bold m-0">
                    {{ $faq->title }}  <small class="text-muted fw-normal ms-1"><i class="fa fa-fw fa-eye"></i> {{ $faq->views_count }} Visualizações</small>
                </p>
                <p class="card-text text-muted small">{{ $faq->description }}</p>
            </div>
            <div class="col-auto">
                <div class="dropdown">
    
                    <button class="btn" type="button" id="dropdownMenuPost{{$faq->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-fw fa-ellipsis-v"></i>
                    </button>
                    
                    <ul class="dropdown-menu fs-6 shadow-sm" aria-labelledby="dropdownMenuButtonPost{{$faq->id}}">
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard.faq.edit', $faq->id) }}">
                                <i class="fa fa-fw fa-edit"></i>
                                Editar
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('web.faq.show', [strtolower(substr($faq->title, 0, 1)), $faq->slug]) }}" target="_blank">
                                <i class="fa fa-fw fa-eye"></i>
                                Visualizar
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#remove-faq-modal" href="{{ route('dashboard.faq.destroy', $faq) }}">
                                <i class="fa fa-fw fa-trash"></i>
                                Remover
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>