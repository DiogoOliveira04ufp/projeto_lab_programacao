@extends('layouts.app')

@section('title', 'Gatos disponíveis')

@section('content')

  {{-- TOPO --}}
  <section class="hero">
    <h1>Gatos disponíveis para adoção</h1>
    <p class="section-text">
      Estes são alguns dos gatos atualmente acolhidos pelo nosso gatil.
      Todos procuram uma família responsável.
    </p>
  </section>

  {{-- LISTA DE GATOS --}}
  @if($gatos->isEmpty())
    <section class="card">
      <p class="muted m-0">Nenhum gato disponível no momento.</p>
    </section>
  @else
    <section class="grid">
      @foreach($gatos as $gato)
        <article class="card">
          
          {{-- FOTO --}}
          @if($gato->foto)
            <img
              src="{{ asset('storage/' . $gato->foto) }}"
              alt="{{ $gato->name }}"
              class="about-img"
            >
          @else
            <img
              src="{{ asset('img/images.jpeg') }}"
              alt="Sem foto"
              class="about-img"
            >
          @endif

          {{-- INFO --}}
          <h3 class="mt-16">{{ $gato->name }}</h3>

          <p class="muted">
            <strong>Raça:</strong> {{ $gato->raca ?? 'Desconhecida' }}
          </p>

          <p class="muted">
            <strong>Idade:</strong>
            {{ $gato->data_nascimento
                ? \Carbon\Carbon::parse($gato->data_nascimento)->age . ' anos'
                : 'Desconhecida'
            }}
          </p>

          @if($gato->historico)
            <p>
              {{ \Illuminate\Support\Str::limit($gato->historico, 140) }}
            </p>
          @endif

        </article>
      @endforeach
    </section>
  @endif

@endsection
