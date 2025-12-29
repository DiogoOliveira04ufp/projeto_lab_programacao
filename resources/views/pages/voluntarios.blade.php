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

    <div class="actions">
      <a class="btn btn-success2" href="{{ route('contactos') }}">Quero voluntariar-me</a>
      <a class="btn btn-success" href="{{ route('doacoes') }}">Apoiar com doação</a>
    </div>
  </section>

  {{-- COMO PODES AJUDAR --}}
  <section class="grid mt-16">
    <article class="card">
      <h3>Apoio no espaço</h3>
      <p>
        Limpeza, alimentação, troca de areia, organização e acompanhamento básico dos gatos.
      </p>
      <a class="btn btn-outline" href="{{ route('contactos') }}">Falar connosco</a>
    </article>

    <article class="card">
      <h3>Transportes</h3>
      <p>
        Levar/ir buscar gatos a consultas, recolhas e deslocações pontuais.
      </p>
      <a class="btn btn-outline" href="{{ route('contactos') }}">Combinar disponibilidade</a>
    </article>

    <article class="card">
      <h3>Divulgação</h3>
      <p>
        Fotografias, posts, partilhas e apoio a campanhas.
      </p>
      <a class="btn btn-outline" href="{{ route('contactos') }}">Saber como ajudar</a>
    </article>
  </section>

  {{-- O QUE PEDIMOS (sem dramatismos) --}}
  <section class="hero mt-16">
    <h2 class="section-title">O que pedimos</h2>
    <p class="section-text">
      Pontualidade, respeito pelas regras do espaço e compromisso com o bem-estar dos animais.
    </p>
  </section>
@endsection
