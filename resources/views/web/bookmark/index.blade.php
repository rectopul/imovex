@extends('layouts.web')

@section('title', 'Favoritos')

@section('content')

    <bookmark-header 
        class="my-5"
        total="{{ collect(session('bookmarks'))->count() }}"
    ></bookmark-header>
    
    <property-card-list-paginate 
        url="{{ route('web.bookmark.property.index') }}"
        paginate
        :records={{ collect(session('bookmarks'))->count() }}
    ></property-card-list-paginate>

    
@endsection
