<?php 

namespace App\Services;

use App\DataTables\UserDataTable;
use App\Models\User;
use Carbon\Carbon;

class UserService
{
    public static function dataTable()
    {
        return (new UserDataTable)->render();
    }

    public static function create($data)
    {
        return User::create($data);
    }

    public static function update(User $user, $data)
    {
        $user->fill($data);

        $user->save();

        return $user;
    }

    public static function delete(User $user)
    {
        $clone = $user;

        $user->delete();

        return $clone;
    }
}