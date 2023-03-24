@extends('layouts.web')

@section('title', 'Conhecimento')

@section('content')

    <blog-template>

		<template v-slot:content>
			
			@isset($highlightPost)
				<blog-highlight :post="{{ json_encode($highlightPost) }}"></blog-highlight>
			@endisset

			<post-card-list 
                url="{{ route('web.blog.post.index', request()->all()) }}"
                container
            >
			</post-card-list>

		</template>

		<template v-slot:sidebar>
			<blog-sidebar
				:posts="{{ json_encode($mostReadPosts) }}"
				:categories="{{ json_encode($mostReadCategories) }}"
			>
			</blog-sidebar>
		</template>

	</blog-template>

@endsection
