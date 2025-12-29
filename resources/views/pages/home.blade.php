@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <section class="hero">
    <h1>Bem-vindo ao Gatil</h1>
    <p>
      Somos uma associação dedicada ao resgate, cuidado e adoção responsável de gatos.
      Aqui encontras gatos disponíveis, formas de ajudar e os nossos contactos.
    </p>

    <div class="actions">
      <a class="btn btn-primary" href="{{ route('gatos') }}">Ver gatos disponíveis</a>
      <a class="btn btn-outline" href="{{ route('doacoes') }}">Apoiar com doação</a>
    </div>
  </section>

  <section class="grid">
    <div class="card">
      <h3>Quem somos</h3>
      <p>
        Acolhemos gatos abandonados, garantimos cuidados veterinários e procuramos famílias responsáveis.
      </p>
      <a class="btn btn-outline" href="{{ route('quem_somos') }}">Saber mais</a>
    </div>

    <div class="card">
      <h3>Gatos disponíveis</h3>
      <p>
        Conhece os nossos gatos prontos para adoção e vê a história de cada um.
      </p>
      <a class="btn btn-outline" href="{{ route('gatos') }}">Ver lista</a>
    </div>

    <div class="card">
      <h3>Contactos</h3>
      <p>
        Tens dúvidas ou queres ser voluntário? Fala connosco.
      </p>
      <a class="btn btn-outline" href="{{ route('contactos') }}">Contactar</a>
    </div>

    <div class="card success span-2">
      <h3>Doações</h3>
      <p>
        As doações ajudam em alimentação, tratamentos e melhores condições no abrigo.
      </p>
      <a class="btn btn-success" href="{{ route('doacoes') }}">Fazer doação</a>
    </div>

    <div class="card">
      <h3>Avaliações</h3>
      <p>
        Feedback de quem adotou e acompanhou o nosso trabalho.
      </p>
      <a class="btn btn-outline" href="{{ route('avaliacoes') }}">Ver avaliações</a>
    </div>
  </section>
@endsection
