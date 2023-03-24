<?php

namespace App\Http\Controllers\Dashboard\WebConfiguration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebConfiguration;
use File;

class WebConfigurationController extends Controller
{
    public function create()
    {
        return view('dashboard.web_configuration.create');
    }

    public function update(Request $request)
    {
        
        $configuration = WebConfiguration::firstOrFail();

        if($request->has('home')) {
            $configuration->home_title = $request->home['title'];
            $configuration->home_subtitle = $request->home['sub_title'];
        }
        
        if($request->has('social')) {
            $configuration->social_facebook = $request->social['facebook'];
            $configuration->social_instagram = $request->social['instagram'];
            $configuration->social_youtube = $request->social['youtube'];
            $configuration->social_whatsapp = $request->social['whatsapp'];
        }

        if($request->has('about')) {
    
            if($request->hasFile('about.cover')) {
                
                $previousCover = $configuration->about_cover;
    
                File::delete(public_path('img/'.$previousCover));
    
                $aboutCover = request()->file('about.cover')->store('sobre', 'public_upload');
                
                $configuration->about_cover = $aboutCover;
            }

            $configuration->about_title = $request->about['title'];
            $configuration->about_description = $request->about['description'];
            $configuration->about_content = $request->about['content'];
        }

        if($request->has('contact')) {
            
            $configuration->contact_title = $request->contact['title'];
            $configuration->contact_email = $request->contact['email'];
            $configuration->contact_work_email = $request->contact['work_email'];
            $configuration->contact_phone = $request->contact['phone'];
            $configuration->contact_message = $request->contact['message'];
        }

        if($request->has('company')) {
            $configuration->company_name = $request->company['name'];
            $configuration->company_cnpj = $request->company['cnpj'];
            $configuration->company_address = $request->company['address'];
            $configuration->company_site = $request->company['site'];
        }

        if($request->has('logo')) {
    
            if($request->hasFile('logo.primary')) {
                
                $previousPrimaryLogo = $configuration->logo_primary;
    
                File::delete(public_path('img/'.$previousPrimaryLogo));
    
                $logoPrimary = request()->file('logo.primary')->store('logo', 'public_upload');
                
                $configuration->logo_primary = $logoPrimary;
            }

            if($request->hasFile('logo.secondary')) {
                
                $previousSecondaryLogo = $configuration->logo_secondary;
    
                File::delete(public_path('img/'.$previousSecondaryLogo));
    
                $logoSecondary = request()->file('logo.secondary')->store('logo', 'public_upload');
                
                $configuration->logo_secondary = $logoSecondary;
            }

        }
        
        $configuration->save();

        return $this->sendSuccessResponse([
            'message' => 'As informações foram atualizadas!'
        ]);
    }
}
