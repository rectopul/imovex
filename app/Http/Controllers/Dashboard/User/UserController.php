<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\User\{UserRequest, UserUpdateRequest};
use App\Services\UserService;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            return UserService::dataTable();
        }
        return view('dashboard.user.index');
    }

    public function create()
    {
        return view('dashboard.user.create');
    }

    public function store(UserRequest $request)
    {
        return UserService::create($request->validated());
    }

    public function edit(User $user) {
        return view('dashboard.user.create', compact('user'));
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $user = UserService::update($user, $request->validated());

        session()->flash('alert', [
            'type' => 'success',
            'body' => 'Usuário <strong>'.$user->name.'</strong> atualizado!'
        ]);
    }

    public function destroy(User $user)
    {
        $user = UserService::delete($user);

        return $this->sendSuccessResponse([
            'reloadDatatable' => 'user-table',
            'message' => 'O usuário <strong>'.$user->name.'</strong> foi removido!'
        ]);
    }
}
