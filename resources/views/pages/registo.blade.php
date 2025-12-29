@extends('layouts.app')

@section('title', 'Registo')

@section('content')
<div class="auth-wrap">
  <div class="auth-card">
    <h1>Criar Conta</h1>
    <p class="auth-sub">Preencha os dados abaixo</p>

    <form method="POST" action="{{ route('registo.post') }}" class="auth-form">
    @csrf

      <label class="field">
        <span>Nome Completo</span>
        <input
          type="text"
          id="name"
          name="name"
          placeholder="Preencha com o seu nome"
          required
        >
        @error('name')
          <small class="error">{{ $message }}</small>
        @enderror
      </label>

      <label class="field">
        <span>Nome de Utilizador</span>
        <input
          type="text"
          id="user"
          name="user"
          placeholder="exemplo1234"
          required
        >
        @error('name')
          <small class="error">{{ $message }}</small>
        @enderror
      </label>

      <label class="field">
        <span>E-mail</span>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="exemplo@email.com"
          required
        >
        @error('email')
          <small class="error">{{ $message }}</small>
        @enderror
      </label>

      <label class="field">
        <span>Palavra-passe</span>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="••••••••"
          required
        >
        @error('password')
          <small class="error">{{ $message }}</small>
        @enderror
      </label>

      <button type="submit" class="btn btn-primary btn-block">Registar</button>

      <p class="auth-footer">
        Já tens conta?
        <a href="{{ route('login') }}">Entrar</a>
      </p>
    </form>
  </div>
</div>
@endsection
