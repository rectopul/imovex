<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        Setting::create([
            'key' => 'home_title',
            'value' => 'Encontre a melhor possibilidade imobiliária para você!'
        ]);

        Setting::create([
            'key' => 'home_sub_title',
            'value' => 'Imóveis por leilão de forma rápida e fácil.'
        ]);

        Setting::create([
            'key' => 'facebook',
            'value' => 'imovelexplorer'
        ]);

        Setting::create([
            'key' => 'instagram',
            'value' => 'imovelexplorer'
        ]);

        Setting::create([
            'key' => 'youtube',
            'value' => 'imovelexplorer'
        ]);

        Setting::create([
            'key' => 'whatsapp',
            'value' => '(00) 00000-0000'
        ]);

        Setting::create([
            'key' => 'about_cover',
            'value' => ''
        ]);

        Setting::create([
            'key' => 'about_title',
            'value' => 'Conheça a Imóvel Explorer e descubra uma nova forma de comprar e vender imóveis'
        ]);

        Setting::create([
            'key' => 'about_description',
            'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam purus diam, gravida aliquet orci quis, vestibulum vehicula libero. Maecenas leo massa, fringilla a ipsum nec, semper vehicula urna. Integer consequat leo a augue hendrerit vehicula. Duis eu sem nec libero accumsan pulvinar nec nec quam. Cras id metus nec magna aliquet consequat nec nec erat. Phasellus magna nisl, porta a hendrerit mollis, placerat nec velit. Curabitur rhoncus consequat ullamcorper. Integer at posuere ex, vel suscipit urna. Quisque quis nunc tempus, interdum libero et, suscipit risus. Nunc aliquam et ante ac condimentum. Duis maximus nec sem a sollicitudin. Nunc sit amet volutpat ligula. Aliquam posuere, augue lobortis suscipit pharetra, quam lorem interdum turpis, sit amet sodales nibh risus elementum ligula. Ut sit amet sapien laoreet, convallis nisl vestibulum, ornare mauris.'
        ]);

        Setting::create([
            'key' => 'about_content',
            'value' => 'Ut quis posuere erat. In augue nulla, blandit dictum massa et, vulputate auctor libero. Vestibulum placerat varius ante, ac placerat enim sagittis vitae. Nulla facilisi. Nam arcu lectus, gravida sit amet mauris quis, eleifend semper leo. Pellentesque quis sem convallis, imperdiet odio non, laoreet libero. Sed est felis, feugiat et nulla in, rutrum dictum justo. Integer urna metus, commodo non tellus eget, sagittis imperdiet elit. Donec sem leo, porttitor eget dui in, efficitur pulvinar tortor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent blandit, nisl at faucibus interdum, dui nibh scelerisque lorem, a euismod massa mi nec tortor.

            Phasellus gravida ipsum dui, vitae facilisis ligula porttitor eget. Praesent tristique nibh lectus, vitae maximus ipsum semper id. Praesent mattis ornare ornare. Donec non egestas magna, nec molestie quam. Sed a justo dui. Morbi commodo ex nec nulla ullamcorper ornare. Morbi vel mauris sit amet tellus vulputate aliquet ac vitae libero. Nam nec consequat urna, non faucibus purus. Vivamus ut risus ac diam lacinia dapibus. Fusce congue nulla eget felis commodo, eu facilisis ipsum ultrices. Maecenas ullamcorper massa eget sapien vestibulum ullamcorper a sit amet mi. Nullam ut sodales velit, elementum ullamcorper neque.'
        ]);

        Setting::create([
            'key' => 'contact_title',
            'value' => 'Quer falar com a gente?'
        ]);

        Setting::create([
            'key' => 'contact_email',
            'value' => 'contato@imovelexplorer.com.br'
        ]);

        Setting::create([
            'key' => 'contact_email_work',
            'value' => 'vaga@imovelexplorer.com.br'
        ]);

        Setting::create([
            'key' => 'contact_phone',
            'value' => '(11) 4118-5638'
        ]);

        Setting::create([
            'key' => 'company_name',
            'value' => 'Imóvel Explorer'
        ]);

        Setting::create([
            'key' => 'company_cnpj',
            'value' => '44.144.814/0001-75'
        ]);

        Setting::create([
            'key' => 'company_address',
            'value' => 'Rua da Rua, 00 - São Paulo - SP'
        ]);

        Setting::create([
            'key' => 'company_site',
            'value' => 'nomedaempresa.com.br'
        ]);

        Setting::create([
            'key' => 'logo_primary',
            'value' => 'site/logo-primary.svg'
        ]);

        Setting::create([
            'key' => 'logo_secondary',
            'value' => 'site/logo-secondary.svg'
        ]);

    }
}
