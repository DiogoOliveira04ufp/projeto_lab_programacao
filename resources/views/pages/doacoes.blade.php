@extends('layouts.app')

@section('title', 'Doações')

@section('content')
  {{-- HERO --}}
  <section class="hero">
    <h1>Doações</h1>
    <p>
      O nosso trabalho depende de doações. Tudo o que entra aqui vai para comida, areia,
      cuidados veterinários e manutenção do espaço.
    </p>

    <div class="actions">
      <a class="btn btn-success" href="{{ route('contactos') }}">Falar connosco</a>
      <a class="btn btn-primary" href="{{ route('gatos') }}">Ver gatos disponíveis</a>
    </div>
  </section>

  {{-- FORMAS DE AJUDA (estrutura simples e clara) --}}
  <section class="grid mt-16">
    <article class="card">
      <h3>Doação monetária</h3>
      <p>
        Se quiseres apoiar com dinheiro, combina connosco a melhor forma (MB Way, transferência, etc.).
      </p>
      <a class="btn btn-outline" href="{{ route('contactos') }}">Pedir dados para doação</a>
    </article>

    <article class="card">
      <h3>Materiais</h3>
      <p>
        Aceitamos ração, areia, transportadoras, mantas, toalhas e medicamentos (dentro do prazo).
      </p>
      <a class="btn btn-outline" href="{{ route('contactos') }}">Confirmar o que precisamos</a>
    </article>

    <article class="card">
      <h3>Serviços</h3>
      <p>
        Transportes, apoio veterinário, fotografia/divulgação e ajuda no espaço fazem diferença real.
      </p>
      <a class="btn btn-outline" href="{{ route('voluntarios') }}">Ver voluntariado</a>
    </article>
  </section>

  {{-- TRANSPARÊNCIA --}}
  <section class="hero mt-16">
    <h2 class="section-title">Transparência</h2>
    <p class="section-text">
      Preferimos ser claros: os recursos são limitados. Se doares, estás a ajudar diretamente
      nos custos diários. Se precisares de comprovativos/recibos ou quiseres saber como usamos
      as doações, pergunta.
    </p>
  </section>
@endsection
