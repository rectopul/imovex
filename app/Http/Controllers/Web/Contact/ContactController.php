<?php

namespace App\Http\Controllers\Web\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Contact\ContactRequest;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('web.contact.create');
    }

    public function store(ContactRequest $request)
    {
        return ContactService::create($request->validated());
    }
}
