<?php

namespace App\Http\Controllers\Dashboard\Privacy;

use App\Http\Controllers\Controller;
use App\Models\WebConfiguration;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function create()
    {
        $privacy = WebConfiguration::firstOrFail()->privacy_term;
        
        return view('dashboard.privacy.create', compact('privacy'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'privacy_term' => 'required',
        ]);

        $webConfiguration = WebConfiguration::firstOrFail();

        $webConfiguration->privacy_term = $request->privacy_term;
        $webConfiguration->save();

        return [
            'toast' => [
                'type' => 'success',
                'message' => 'Termo de privacidade atualizado com sucesso!',
            ]
        ];

    }
}
