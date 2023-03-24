<?php 

namespace App\Services;

use App\DataTables\FaqDataTable;
use App\Models\Faq;
use App\Models\FaqView;
use App\Models\Visitor;
use Carbon\Carbon;

class FaqService
{
    public static function dataTable()
    {
        return (new FaqDataTable)->render();
    }

    public static function create($data)
    {
        return Faq::create([
            'title' =>$data['title'],
            'description' => $data['description'],
            'body' => $data['body']
        ]);
    }

    public static function update(Faq $faq, $data)
    {
        $faq->title = $data['title'];
        $faq->description = $data['description'];
        $faq->body = $data['body'];

        $faq->save();

        return $faq;
    }

    public static function delete(Faq $faq)
    {
        $clone = $faq;

        $faq->views()->delete();
        $faq->delete();

        return $clone;
    }

    public static function visitFaq(Faq $faq, Visitor $visitor)
    {
        FaqView::firstOrCreate(
            [
                'faq_id' => $faq->id,
                'visitor_id' => $visitor->id
            ],
            [
                'viewed_at' => Carbon::now()
            ]
        );
    }
}