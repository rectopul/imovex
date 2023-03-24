@extends('layouts.web')

@section('title', $post->title)

@section('content')
	
	<blog-template>

		<template v-slot:content>
			<post-details :post="{{ $post }}"></post-details>
		</template>

		<template v-slot:sidebar>
			<blog-sidebar
				:posts="{{ json_encode($posts) }}"
				:categories="{{ json_encode($categories) }}"
			>
			</blog-sidebar>
		</template>

	</blog-template>

@endsection
