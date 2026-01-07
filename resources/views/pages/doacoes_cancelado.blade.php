@extends('layouts.app')

@section('title', 'Doação cancelada')

@section('content')
  <section class="hero">
    <h1>Doação cancelada</h1>
    <p>Não foi feito nenhum pagamento.</p>

    <div class="actions">
      <a class="btn btn-primary" href="{{ route('doacoes') }}">Tentar novamente</a>
      <a class="btn btn-outline" href="{{ route('contactos') }}">Falar connosco</a>
    </div>
  </section>
@endsection
