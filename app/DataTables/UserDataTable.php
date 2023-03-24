<?php

namespace App\DataTables;

use App\Models\User;

class UserDataTable
{
    public function render()
    {
        return datatables()->of(User::query())
        ->addColumn('actions', function($user){
            return view('dashboard.user.actions', compact('user'));
        })
        ->toJson();
    }
}