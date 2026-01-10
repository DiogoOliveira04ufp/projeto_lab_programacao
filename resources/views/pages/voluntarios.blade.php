@extends('layouts.app')

@section('title', 'Voluntariado')

@section('content')
  {{-- HERO --}}
  <section class="hero">
    <h1>Voluntariado</h1>
    <p>
      Precisamos de ajuda regular. Se tens tempo e responsabilidade, há sempre tarefas para fazer.
      Se não tens disponibilidade fixa, também dá para ajudar pontualmente.
    </p>

    @if ($errors->any())
      <div class="card mt-16">
        <strong>Há erros no formulário:</strong>
        <ul class="mt-16">
          @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </section>

  {{-- COMO PODES AJUDAR --}}
  <section class="grid mt-16">
    <article class="card">
      <h3>Apoio no espaço</h3>
      <p>
        Limpeza, alimentação, troca de areia, organização e acompanhamento básico dos gatos.
      </p>
    </article>

    <article class="card">
      <h3>Transportes</h3>
      <p>
        Levar/ir buscar gatos a consultas, recolhas e deslocações pontuais.
      </p>
    </article>

    <article class="card">
      <h3>Divulgação</h3>
      <p>
        Fotografias, posts, partilhas e apoio a campanhas.
      </p>
    </article>
  </section>

  {{-- O QUE PEDIMOS --}}
  <section class="hero mt-16">
    <h2 class="section-title">O que pedimos</h2>
    <p class="section-text">
      Pontualidade, respeito pelas regras do espaço e compromisso com o bem-estar dos animais.
    </p>
  </section>

  {{-- FORMULÁRIO DE VOLUNTARIADO (só aparece se NÃO for voluntário) --}}
  @if(!(auth()->check() && auth()->user()->isVolunteer()))
    <section id="voluntariado-form" class="hero mt-16">
      <h2 class="section-title">Quero voluntariar-me</h2>

      @if (session('success'))
        <div class="card mt-16">
          <strong>{{ session('success') }}</strong>
        </div>
      @endif

      @if ($errors->any())
        <div class="card mt-16">
          <ul>
            @foreach ($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('voluntarios.send') }}" class="mt-16">
        @csrf

        <input type="hidden" name="assunto" value="Pedido de voluntariado">

        <div class="grid">
          <article class="card">
            <label>Nome</label>
            <input name="nome" value="{{ old('nome', auth()->user()->name ?? '') }}" readonly>
          </article>

          <article class="card">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" readonly>
          </article>

          <article class="card span-2">
            <label>Mensagem</label>
            <textarea name="mensagem" rows="6" placeholder="Diga-nos a sua disponibilidade para reunir." required>{{ old('mensagem') }}</textarea>
          </article>
        </div>

        <button class="btn btn-primary mt-16" type="submit">
          Enviar pedido de voluntariado
        </button>
      </form>
    </section>
  @else
    <div class="card mt-16">
      <h2 class="section-title">És Voluntário</h2>
      <p class="muted mt-8">O teu pedido foi aceite. Usa a área de voluntários.</p>

      <a href="{{ route('voluntarios.area') }}" class="btn btn-success mt-16">
        Entrar na Área de Voluntários
      </a>
    </div>
  @endif
@endsection
