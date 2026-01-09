@extends('layouts.app')

@section('title', 'Voluntariado')

@section('content')
  {{-- HERO + FORMULÁRIO --}}
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

  {{--  Área de Voluntarios--}}
  @if(auth()->check() && (auth()->user()->isVolunteer() || auth()->user()->isAdmin()))
  <div class="card mt-16">
    <h2 class="section-title">Área do Voluntário</h2>
    <p class="muted mt-8">
      Aqui podes acompanhar os teus pedidos, informações internas e comunicações do gatil.
    </p>

    <a href="{{ route('voluntarios.area') }}" class="btn btn-success">
      Entrar na Área de Voluntários
    </a>
  </div>
  @endif


  {{-- FORMULÁRIO DE VOLUNTARIADO --}}
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

      {{-- assunto fixo --}}
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

@endsection
