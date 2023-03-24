<div class="dropdown h-100 w-100">
    <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-fw fa-ellipsis-v"></i>
    </button>
    <ul class="dropdown-menu">
        @if(!$contact->replied)
            <li>
                <a class="dropdown-item mark-read" href="{{ route('dashboard.contact.update', $contact) }}">
                    <i class="fa fa-fw fa-check"></i> Marcar como respondido
                </a>
            </li>
        @endif
        <li>
            <a class="dropdown-item remove-contact" href="{{ route('dashboard.contact.destroy', $contact) }}" data-bs-toggle="modal" data-bs-target="#remove-modal">
                <i class="fa fa-fw fa-trash"></i> Remover
            </a>
        </li>
    </ul>
</div>