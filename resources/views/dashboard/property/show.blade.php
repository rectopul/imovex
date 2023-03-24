@extends('layouts.dashboard')

@section('pageTitle', 'Imovél')

@section('title')

<div class="row my-4">
	<div class="col-md-12">
		<h1 class="h3 text-muted">
			<i class="fa fa-fw fa-building"></i>
			Imóvel
		</h1>
	</div>
</div>

@endsection

@section('content')

	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">

					<div class="row">
						@foreach($property->images as $image)
							@if($image)
								<div class="col-lg-4 mb-3">
									<img src="{{ $image }}" alt="" class="w-100 rounded">
								</div>
							@endif
						@endforeach
					</div>

					<ul class="list-group">
						@foreach($property->getAttributes() as $key => $value)
							{{-- @if(!str_contains($key, 'url') && $key != '') --}}
								<li class="list-group-item d-flex justify-content-between align-items-start">
									<div class="ms-2 me-auto">
										
										<div class="fw-bold">
											{{ ucwords(str_replace('_', ' ', $key)) }}
										</div>
										{{ $value }}
										
									</div>
								</li>
							{{-- @endif --}}
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>

@endsection