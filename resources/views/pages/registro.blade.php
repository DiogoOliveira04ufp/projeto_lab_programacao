@extends('layouts.app')
@section('title', 'Registro')
@section('content')
  <div class="register-page-container">
    <div class="register-card">
        <div class="register-header">
            <h2>Criar Conta</h2>
            <p>Junte-se a nós preenchendo os dados abaixo</p>
        </div>

        <form method="POST" action="{{ route('registro') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Seu nome">
                @error('name') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email">E-mail (Gmail)</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="exemplo@gmail.com">
                @error('email') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Palavra-passe</label>
                <input type="password" id="password" name="password" required placeholder="Mínimo 8 caracteres">
                @error('password') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Palavra-passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Repita a palavra-passe">
            </div>

            <button type="submit" class="btn-register">
                Criar Minha Conta
            </button>

            <div class="login-link">
                Já tem conta? <a href="{{ route('login') }}">Inicie sessão</a>
            </div>
        </form>
    </div>
</div>

@endsection
