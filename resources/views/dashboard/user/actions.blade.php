<div class="dropdown">
    
    <button class="btn" type="button" id="dropdownMenuPost{{$user->id}}" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-fw fa-ellipsis-v"></i>
    </button>
    
    <ul class="dropdown-menu fs-6 shadow-sm" aria-labelledby="dropdownMenuButtonPost{{$user->id}}">
        <li>
            <a class="dropdown-item" href="{{ route('dashboard.user.edit', $user->id) }}">
                <i class="fa fa-fw fa-edit"></i>
                Editar
            </a>
        </li>
        @if($user->id != auth()->user()->id)
        <li>
            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#remove-user-modal" href="{{ route('dashboard.user.destroy', $user) }}">
                <i class="fa fa-fw fa-trash"></i>
                Remover
            </a>
        </li>
        @endif
    </ul>
</div>