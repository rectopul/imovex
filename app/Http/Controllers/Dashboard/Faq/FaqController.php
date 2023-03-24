<?php

namespace App\Http\Controllers\Dashboard\Faq;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Faq\FaqRequest;
use App\Models\Faq;
use App\Services\FaqService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            return FaqService::dataTable();
        }
        return view('dashboard.faq.index');
    }

    public function create()
    {
        return view('dashboard.faq.create');
    }

    public function store(FaqRequest $request)
    {
        return FaqService::create($request->validated());
    }

    public function edit(Faq $faq) {
        return view('dashboard.faq.create', compact('faq'));
    }

    public function update(Faq $faq, FaqRequest $request)
    {
        $faq = FaqService::update($faq, $request->validated());

        session()->flash('alert', [
            'type' => 'success',
            'body' => 'Faq <strong>'.$faq->title.'</strong> atualizado!'
        ]);
    }

    public function destroy(Faq $faq)
    {
        $faq = FaqService::delete($faq);

        return $this->sendSuccessResponse([
            'reloadDatatable' => 'faq-table',
            'message' => 'O faq <strong>'.$faq->title.'</strong> foi removido!'
        ]);
    }
}
