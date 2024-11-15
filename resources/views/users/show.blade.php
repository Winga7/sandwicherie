@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de l'utilisateur</h1>
    <p><strong>Nom :</strong> {{ $user->name }}</p>
    <p><strong>Email :</strong> {{ $user->email }}</p>
    <p><strong>Rôle :</strong> {{ $user->roles->pluck('name')->join(', ') }}</p>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
