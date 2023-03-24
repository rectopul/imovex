<?php

namespace App\Services;

use App\Models\Contact;
use App\DataTables\ContactDataTable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactService
{
	private $viewsPath = 'admin.contacts';

	public static function dataTable()
	{
		return (new ContactDataTable)->render();
	}

	public static function handleAjax($request)
	{
		if($request->has('count')) {
		    return Contact::notRead()->count();
		}

		return self::dataTable();
	}

	public static function readMessage(Contact $contact)
	{
		if(!$contact->read) {
		    $contact->read = Carbon::now();
		    $contact->save();
		}
	}

	public static function replyMessage(Contact $contact)
	{
		if(!$contact->replied) {
		    $contact->replied = Carbon::now();
		    $contact->save();
		}
	}

	public function renderView()
	{
		return view($this->viewsPath);
	}

	public static function create($data)
	{
		$contact = new Contact($data);

		$contact->save();

		return $contact;
	}
}