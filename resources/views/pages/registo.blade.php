@extends('layouts.app')

@section('title', 'Registo Profissional')

@section('content')
<style>
    /* 1. Contentor Principal: Ocupa 100% da altura da janela e centra tudo */
    .main-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Fundo moderno */
        padding: 20px;
    }

    /* 2. O "Quadrado" (Card) do Formulário */
    .register-card {
        background: #ffffff;
        width: 100%;
        max-width: 420px; /* Tamanho ideal para leitura */
        padding: 3rem;
        border-radius: 24px; /* Cantos bem arredondados */
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); /* Sombra profunda */
        transition: transform 0.3s ease;
    }

    /* Título e subtítulo */
    .register-card h2 {
        color: #1a202c;
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        text-align: center;
        letter-spacing: -1px;
    }

    .register-card p {
        color: #718096;
        text-align: center;
        margin-bottom: 2rem;
    }

    /* 3. Inputs */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.6rem;
        font-size: 0.9rem;
    }

    .form-group input {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #edf2f7;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: #f7fafc;
    }

    .form-group input:focus {
        outline: none;
        border-color: #667eea;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
    }

    /* 4. O Botão Estilizado */
    .btn-gradient {
        width: 100%;
        padding: 16px;
        background: linear-gradient(to right, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 15px -3px rgba(102, 126, 234, 0.4);
        margin-top: 1rem;
    }

    .btn-gradient:hover {
        transform: translateY(-2px); /* Efeito de levitar */
        box-shadow: 0 20px 25px -5px rgba(102, 126, 234, 0.5);
        filter: brightness(1.1);
    }

    .btn-gradient:active {
        transform: translateY(0);
    }

    /* 5. Link de volta */
    .footer-link {
        text-align: center;
        margin-top: 2rem;
        font-size: 0.9rem;
        color: #a0aec0;
    }

    .footer-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 700;
    }

    .footer-link a:hover {
        text-decoration: underline;
    }

    /* Erros do Laravel */
    .invalid-feedback {
        color: #e53e3e;
        font-size: 0.8rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }
</style>

<div class="main-container">
    <div class="register-card">
        <h2>Criar Conta</h2>
        <p>Preencha os dados abaixo</p>

        <form method="POST" action="{{ route('registro') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="name" placeholder="Como se chama?" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">E-mail Profissional</label>
                <input type="email" id="email" name="email" placeholder="exemplo@gmail.com" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">Palavra-passe</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn-gradient">
                Registar Agora
            </button>

            <div class="footer-link">
                Já tem conta? <a href="{{ route('login') }}">Entrar</a>
            </div>
        </form>
    </div>
</div>
@endsection
