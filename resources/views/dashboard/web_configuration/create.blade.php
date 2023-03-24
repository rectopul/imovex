@extends('layouts.dashboard')

@section('pageTitle', 'Configurações')

@section('title')
    
    <div class="row my-4">
        <div class="col-md-12">
            <h1 class="h3 text-muted">
                <i class="fa fa-fw fa-cogs"></i>
                Configurações
            </h1>
        </div>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/summernote.css') }}">
@endpush

@section('content')
	
    <div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button" role="tab" aria-controls="social" aria-selected="false">Redes Sociais</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false">Sobre</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contato</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="company-tab" data-bs-toggle="tab" data-bs-target="#company" type="button" role="tab" aria-controls="company" aria-selected="false">Empresa</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="logo-tab" data-bs-toggle="tab" data-bs-target="#logo" type="button" role="tab" aria-controls="logo" aria-selected="false">Logo</button>
						</li>
					</ul>
					<div class="tab-content p-3" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<home-form 
								title="{{ config('web.home_title') }}"
								sub-title="{{ config('web.home_subtitle') }}"
							>
						</home-form>
					</div>
	
					<div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
						<social-form
							facebook="{{ config('web.social_facebook') }}"
							instagram="{{ config('web.social_instagram') }}"
							youtube="{{ config('web.social_youtube') }}"
							whatsapp="{{ config('web.social_whatsapp') }}"
						>
						</social-form>
					</div>
	
					<div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
						<about-form
							cover="{{ config('web.about_cover') ? asset('img/'.config('web.about_cover')) : '' }}"
							title="{{ config('web.about_title') }}"
							description="{{ config('web.about_description') }}"
							content="{{ config('web.about_content') }}"
						>
						</about-form>
					</div>
	
					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						<contact-form
							title="{{ config('web.contact_title') }}"
							email="{{ config('web.contact_email') }}"
							work-email="{{ config('web.contact_work_email') }}"
							phone="{{ config('web.contact_phone') }}"
							message="{{ config('web.contact_message') }}"
						>
						</contact-form>
					</div>
					<div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">
						<company-form
							cnpj="{{ config('web.company_cnpj') }}"
							name="{{ config('web.company_name') }}"
							address="{{ config('web.company_address') }}"
							site="{{ config('web.company_site') }}"
						>
						</company-form>
					</div>
					<div class="tab-pane fade" id="logo" role="tabpanel" aria-labelledby="logo-tab">
						<logo-form
							primary="{{ config('web.logo_primary') ? asset('img/'.config('web.logo_primary')) : '' }}"
							secondary="{{ config('web.logo_secondary') ? asset('img/'.config('web.logo_secondary')) : '' }}"
						>
						</logo-form>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>

@endsection