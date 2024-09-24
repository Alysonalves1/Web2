@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Novo Usuário</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Perfil</label>
            <select class="form-control" id="role" name="role" required>
                <option value="" disabled selected>Selecione um papel</option>
                <option value="admin">Admin</option>
                <option value="bibliotecario">Bibliotecário</option>
                <option value="cliente">Cliente</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Criar Usuário</button>

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    </form>
</div>
@endsection
