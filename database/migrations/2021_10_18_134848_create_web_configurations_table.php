<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_configurations', function (Blueprint $table) {
            $table->id();
            
            $table->string('home_title');
            $table->string('home_subtitle');
            
            $table->string('social_facebook');
            $table->string('social_instagram');
            $table->string('social_youtube');
            $table->string('social_whatsapp');

            $table->string('about_cover');
            $table->string('about_title');
            $table->longtext('about_description');
            $table->longtext('about_content');

            $table->string('contact_title');
            $table->string('contact_email');
            $table->string('contact_work_email');
            $table->string('contact_phone');

            $table->string('company_name');
            $table->string('company_cnpj');
            $table->string('company_address');
            $table->string('company_site');
            
            $table->string('logo_primary');
            $table->string('logo_secondary');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_configurations');
    }
}
