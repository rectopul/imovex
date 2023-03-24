<?php

namespace App\Http\Controllers\Web\Bookmark;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Bookmark\BookmarkRequest;
use App\Models\Property;
use App\Services\VisitorService;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        return view('web.bookmark.index');
    }

    public function store(BookmarkRequest $request)
    {
        VisitorService::addPropertyToBookmarks($request->property_id);

        return [
            'property_id' => $request->property_id
        ];
    }

    public function destroy($id)
    {
        return VisitorService::removePropertyFromBookmarks($id);
    }
}
