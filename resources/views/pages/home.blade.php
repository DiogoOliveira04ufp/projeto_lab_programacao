@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="p-4 p-md-5 mb-4 bg-light rounded-3 border">
  <div class="container-fluid py-2">
    <h1 class="display-6 fw-bold">Bem-vindo ao Gatil</h1>
    <p class="col-lg-8 fs-5">
      Somos uma associação dedicada ao resgate, cuidado e adoção responsável de gatos.
    </p>
    <div class="d-flex gap-2 flex-wrap">
      <a class="btn btn-primary btn-lg" href="{{ route('gatos') }}">Ver gatos disponíveis</a>
      <a class="btn btn-outline-secondary btn-lg" href="{{ route('doacoes') }}">Apoiar com doação</a>
    </div>
  </div>
</div>

<div class="row g-4">
  <div class="col-12 col-md-6 col-lg-4">
    <div class="card h-100 shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Quem somos</h5>
        <p class="card-text">
          Acolhemos gatos abandonados, garantimos cuidados veterinários e procuramos famílias responsáveis.
        </p>
        <a href="{{ route('quem_somos') }}" class="btn btn-sm btn-outline-primary">Saber mais</a>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-6 col-lg-4">
    <div class="card h-100 shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Gatos disponíveis</h5>
        <p class="card-text">
          Conhece os nossos gatos prontos para adoção e vê a história de cada um.
        </p>
        <a href="{{ route('gatos') }}" class="btn btn-sm btn-outline-primary">Ver lista</a>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-6 col-lg-4">
    <div class="card h-100 shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Contactos</h5>
        <p class="card-text">
          Tens dúvidas ou queres ser voluntário? Fala connosco.
        </p>
        <a href="{{ route('contactos') }}" class="btn btn-sm btn-outline-primary">Contactar</a>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-6">
    <div class="card h-100 border-success shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Doações</h5>
        <p class="card-text">
          As doações ajudam em alimentação, tratamentos e melhores condições no abrigo.
        </p>
        <a href="{{ route('doacoes') }}" class="btn btn-success">Fazer doação</a>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-6">
    <div class="card h-100 shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Avaliações</h5>
        <p class="card-text">
          Feedback de quem adotou e acompanhou o nosso trabalho.
        </p>
        <a href="{{ route('avaliacoes') }}" class="btn btn-outline-primary">Ver avaliações</a>
      </div>
    </div>
  </div>
</div>

@endsection
