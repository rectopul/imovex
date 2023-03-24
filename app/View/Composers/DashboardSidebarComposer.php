<?php

namespace App\View\Composers;

use App\Models\Contact;
use Illuminate\View\View;

class DashboardSidebarComposer
{
	protected $messages;

	public function __construct()
	{
		$this->messages = Contact::notRead()->count();
	}

	public function compose(View $view)
	{
	 	$view->with('newMessages', $this->messages);
	}
}