<?php

namespace App\DataTables;

use App\Models\Contact;
use Carbon\Carbon;

class ContactDataTable
{

    public function render()
    {
        Carbon::setLocale('pt_BR');

        return datatables()->of($this->query())
            ->setRowAttr([
                'data-url' => function($contact) {
                    return route('dashboard.contact.show', $contact);
                },
            ])
            ->setRowClass(function ($contact) {
                return $contact->read ? '' : 'bg-light';
            })
            ->filter(function($query){
                
                if(request()->created_at == 'ASC') $query->orderBy('created_at', 'ASC');
                if(request()->created_at == 'DESC') $query->orderBy('created_at', 'DESC');

                if(request()->has('search.value')) {
                    
                    $query->where('name', 'like', '%'.request('search.value').'%')
                        ->orWhere('email', 'like', '%'.request('search.value').'%')
                        ->orWhere('subject', 'like', '%'.request('search.value').'%')
                        ->orWhere('message', 'like', '%'.request('search.value').'%');

                }

            })
            ->editColumn('name', function($contact){

                $badge = '';

                if(!$contact->read) {
                    
                    $badge =  ' <span class="badge bg-success">não lido</span>';
                    
                } else if($contact->replied) {
                    
                    $badge = ' <span class="badge bg-info">respondido</span>';

                }

                return '<strong>'.$contact->name.'</strong>'.$badge;
            })
            ->editColumn('created_at', function($contact){
                return $contact->created_at->diffForHumans();
            })
            ->editColumn('subject', function($contact){
                return $contact->subject.' - <span class="text-muted">'.$contact->message.'</span>';
            })
            ->addColumn('actions', function($contact){
                return view('dashboard.contact.actions', ['contact' => $contact]);
            })
            ->rawColumns(['name', 'subject'])
            ->toJson();
    }

    private function query()
    {
        return Contact::query();
    }
}
