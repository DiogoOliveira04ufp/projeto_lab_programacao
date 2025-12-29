@extends('layouts.app') {{-- ou layouts.app se fizeres o rename da pasta --}}

@section('title', 'Login')

@section('content')
<div class="auth-wrap">
  <div class="auth-card">
    <h1>Entrar</h1>
    <p class="auth-sub">Introduza os seus dados de acesso</p>

    <form method="POST" action="{{ route('login.post') }}" class="auth-form">
      @csrf

      <label class="field">
        <span>Email</span>
        <input
          type="email"
          name="email"
          placeholder="exemplo@email.com"
          value="{{ old('email') }}"
          autocomplete="email"
          required
        >
        @error('email')
          <small class="error">{{ $message }}</small>
        @enderror
      </label>

      <label class="field">
        <span>Senha</span>
        <input
          type="password"
          name="password"
          placeholder="********"
          autocomplete="current-password"
          required
        >
        @error('password')
          <small class="error">{{ $message }}</small>
        @enderror
      </label>


      <button type="submit" class="btn btn-primary btn-block">Entrar</button>

      <p class="auth-footer">
        Ainda não tens conta?
        <a href="{{ route('registo') }}">Regista-te</a>
      </p>
    </form>
  </div>
</div>
@endsection
