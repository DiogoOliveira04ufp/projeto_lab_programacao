@extends('layouts.app')
@section('title', 'Login')
@section('content')

 <div class="login-wrapper">
    <div class="login-card">
        <h2>Entrar</h2>
        <p>Introduza os seus dados de acesso</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="exemplo@email.com">
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
                @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-submit">Entrar</button>
        </form>
    </div>
</div>
@endsection