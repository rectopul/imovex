<div class="dropdown">
    
    <button class="btn" type="button" id="dropdownMenuPost{{$faq->id}}" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-fw fa-ellipsis-v"></i>
    </button>
    
    <ul class="dropdown-menu fs-6 shadow-sm" aria-labelledby="dropdownMenuButtonPost{{$faq->id}}">
        <li>
            <a class="dropdown-item" href="{{ route('admin.faqs.edit', $faq->id) }}">
                <i class="fa fa-fw fa-edit"></i>
                Editar
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('faq.show', [strtolower(substr($faq->title, 0, 1)), $faq->slug]) }}" target="_blank">
                <i class="fa fa-fw fa-eye"></i>
                Visualizar
            </a>
        </li>
        <li>
            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#remove-faq-modal" href="{{ route('admin.faqs.destroy', $faq) }}">
                <i class="fa fa-fw fa-trash"></i>
                Remover
            </a>
        </li>
    </ul>
</div>