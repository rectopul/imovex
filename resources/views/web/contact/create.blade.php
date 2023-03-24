@extends('layouts.web')

@section('title', 'Contato')

@section('content')
	
	<contact-template>
        
		<template v-slot:header>
			<contact-header
				title="{{ config('web.contact_title') }}"
			>
			</contact-header>
		</template>

		<template v-slot:message>
			<contact-message
				phone="{{ config('web.contact_phone') }}"
				email="{{ config('web.contact_email') }}"
				work-email="{{ config('web.contact_work_email') }}"
				message="{{ config('web.contact_message') }}"
			>
			</contact-message>
		</template>

		<template v-slot:form>
			<contact-form
                url="{{ route('web.contact.store') }}"
            ></contact-form>
		</template>

	</contact-template>

@endsection
