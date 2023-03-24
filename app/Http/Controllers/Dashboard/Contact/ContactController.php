<?php

namespace App\Http\Controllers\Dashboard\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request) 
    {
        if($request->ajax()) {
            return ContactService::handleAjax($request);
        }

        return view('dashboard.contact.index');
    }

    public function update(Contact $contact)
    {
        ContactService::replyMessage($contact);

        return $this->sendSuccessResponse([
            'reloadDatatable' => 'contact-table',
            'type' => 'success',
            'body' => 'Mensagem marcada como respondida!',
        ]);

    }

    public function show(Request $request, Contact $contact) 
    {
        ContactService::readMessage($contact);

        return view('dashboard.contact.show', compact('contact'));
    }

    public function destroy(Contact $contact) 
    {
        $contact->delete();

        $this->setAlertSuccess('Mensagem excluída!');

        return $this->sendSuccessResponse([
            'reloadDatatable' => 'contact-table',
            'type' => 'danger',
            'message' => 'Mensagem excluída!',
        ]);
    }
}
