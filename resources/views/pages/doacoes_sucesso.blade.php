@extends('layouts.app')

@section('title', 'Doação concluída')

@section('content')
  <section class="hero">
    <h1>Obrigado!</h1>
    <p>A tua doação foi concluída com sucesso (modo teste).</p>

    @if(isset($donation) && $donation)
      <div class="actions mt-16">
        <a class="btn btn-outline" href="{{ route('doacoes.recibo', $donation) }}">
          Descarregar recibo (PDF)
        </a>
      </div>
    @else
      <p class="muted mt-16">
        A doação ainda está a ser registada. Atualiza esta página em alguns segundos.
      </p>
    @endif

    <div class="actions mt-16">
      <a class="btn btn-primary" href="{{ route('doacoes') }}">Voltar às doações</a>
      <a class="btn btn-success2" href="{{ route('home') }}">Ir para a home</a>
    </div>
  </section>
@endsection
