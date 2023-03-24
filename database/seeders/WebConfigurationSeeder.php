<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebConfiguration;

class WebConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebConfiguration::truncate();


        WebConfiguration::create([

            'home_title' => 'Encontre a melhor possibilidade imobiliária para você!',
            'home_subtitle' => 'Imóveis por leilão de forma rápida e fácil.',

            'social_facebook' => 'imovelexplorer',
            'social_instagram' => 'imovelexplorer',
            'social_youtube' => 'imovelexplorer',
            'social_whatsapp' => '(00) 00000-0000',

            'about_cover' => 'web/about.png',
            'about_title' => 'Conheça a Imóvel Explorer e descubra uma nova forma de comprar e vender imóveis',
            'about_description' => '',
            'about_content' => '',

            'contact_title' => 'Quer falar com a gente?',
            'contact_email' => 'contato@imovelexplorer.com.br',
            'contact_work_email' => 'vaga@imovelexplorer.com.br',
            'contact_phone' => '(11) 4118-5638',

            'company_name' => 'Imóvel Explorer',
            'company_cnpj' => '44.144.814/0001-75',
            'company_address' => 'Rua da Rua, 00 - São Paulo - SP',
            'company_site' => 'nomedaempresa.com.br',
            
            'logo_primary' => 'web/logo-primary.png',
            'logo_secondary' => 'web/logo-secondary.png'

        ]);

    }
}
