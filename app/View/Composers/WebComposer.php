<?php

namespace App\View\Composers;

use App\Services\VisitorService;
use Illuminate\View\View;

class WebComposer
{
	private $visitor;
	
	public function __construct()
	{
        $this->visitor = VisitorService::getVisitor();
		VisitorService::setLastActivity($this->visitor);
	}

	public function compose(View $view)
	{
		if($view->getName() == 'web.blog.post.show') {
			VisitorService::visitPost($view->getData()['post'], $this->visitor);
		}
		
		if($view->getName() == 'web.faq.index' && $view->getData() && isset($view->getData()['faq']->id)) {
			VisitorService::visitFaq($view->getData()['faq'], $this->visitor);
		}

		if($view->getName() == 'web.product.show') {
			VisitorService::visitProperty($view->getData()['property'], $this->visitor);
		}

	 	$view->with(['visitor' => $this->visitor]);

	}

}