@extends('layouts.auth')

@section('content')
<div class="row">
    <div class="col-xl-7 mx-auto py-5">

        <div class="card shadow-lg border-0 rounded-xl">
            <div class="card-body py-5">
                <div class="row">
                    <div class="col-xl-6 d-flex flex-column align-items-center justify-content-center border-end">
                        <img src="{{ config('web.logo_secondary') ? asset('img/'.config('web.logo_secondary')) : '' }}" alt="">
                    </div>
                    <div class="col-xl-6 p-4">
                        <div class="text-center">
                            <p class="m-0 fs-3">Bem Vindo</p>
                            <small>Área Administrativa</small>
                        </div>

                        <login-form></login-form>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection