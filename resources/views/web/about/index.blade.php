@extends('layouts.web')

@section('title', 'Sobre')

@section('content')

	<about-vectors class="d-none d-lg-block"></about-vectors>
	
	<about-hero
		title="{{ config('web.about_title') }}"
		cover="{{ asset('img/'.config('web.about_cover')) }}"
		description="{{ config('web.about_description') }}"
	>
	</about-hero>

	<about-content
		description="{{ config('web.about_description') }}"
		content="{{ config('web.about_content') }}"
	>
	</about-content>

@endsection
