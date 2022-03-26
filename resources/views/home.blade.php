{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts/master')
@section('content')
<div class="row">
    <div class="col-md-12 p-4">
        <div class="jumbotron">
            <h1 class="display-4">Bienvenue<strong> {{user_full_name()}}</strong>, sur le gestionnaire de catalogue zino</h1>
            <p class="lead">Cette application vous permet de gérer vos clients, vos produits, vos ventes et vos
                factures.</p>
            <hr class="my-4">
            <p>Pour commencer, veuillez vous connecter ou créer un compte.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">En savoir plus</a>
            </p>
        </div>
</div>
</div>

@endsection