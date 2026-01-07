@extends('layouts.app')

@section('title', 'Doação concluída')

@section('content')
  <section class="hero">
    <h1>Obrigado!</h1>
    <p>A tua doação foi concluída com sucesso (modo teste).</p>

    <div class="actions">
      <a class="btn btn-primary" href="{{ route('doacoes') }}">Voltar às doações</a>
      <a class="btn btn-success2" href="{{ route('home') }}">Ir para a home</a>
    </div>
  </section>
@endsection
