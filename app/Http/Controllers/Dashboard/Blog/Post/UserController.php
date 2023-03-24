<?php

namespace App\Http\Controllers\Dashboard\Blog\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::select('id', 'name')
        ->has('posts')
        ->get();
    }
}
