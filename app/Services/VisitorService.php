<?php 

namespace App\Services;

use App\Models\{
    Faq,
    FaqView,
    Post,
    PostView,
    Property,
    PropertyView,
    Visitor
};

use Illuminate\Support\Facades\Cookie;

class VisitorService
{
    public static function getVisitor()
    {
        return Visitor::firstOrCreate([
    		'ip_address' => request()->ip(),
    		'user_agent' => request()->userAgent()
    	]);
    }

    public static function setLastActivity(Visitor $visitor)
    {
        $visitor->last_activity = now();
    	$visitor->save();
    }

    public static function visitPost(Post $post, Visitor $visitor) 
	{
		PostView::firstOrCreate(
			[
				'post_id' => $post->id,
				'visitor_id' => $visitor->id
			],
			[
				'viewed_at' => now()
			]
		);
	}

    public static function visitFaq(Faq $faq, Visitor $visitor)
    {
        FaqView::firstOrCreate(
            [
                'faq_id' => $faq->id,
                'visitor_id' => $visitor->id
            ],
            [
                'viewed_at' => now()
            ]
        );
    }

    public static function visitProperty(Property $property, Visitor $visitor)
    {
        PropertyView::firstOrCreate(
            [
                'property_id' => $property->id,
                'visitor_id' => $visitor->id
            ],
            [
                'viewed_at' => now()
            ]
        );
    }

    public static function addPropertyToHistory($id)
    {
        $history = collect(session('history'));

        $history->push($id);

        session(['history' => $history]);
    }

    public static function addPropertyToBookmarks($id)
    {
        $bookmarks = collect(session('bookmarks'));

        $bookmarks->push($id);

        session(['bookmarks' => $bookmarks]);
    }

    public static function removePropertyFromBookmarks($id)
    {
        $bookmarks = collect(session('bookmarks'));

        $bookmarks = $bookmarks->reject(fn ($value) => $value == $id);

        session(['bookmarks' => $bookmarks]);
    }
}