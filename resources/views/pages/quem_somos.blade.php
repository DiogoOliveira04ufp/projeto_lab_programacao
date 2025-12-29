@extends('layouts.app')

@section('title', 'Quem Somos')

@section('content')
  <section class="hero about-hero">
    <div>
      <h1>Quem Somos</h1>
      <p>
        O Gatil Arca d’Água é uma associação dedicada ao resgate e proteção de gatos abandonados.
        Trabalhamos com voluntários e doações para garantir cuidados básicos e encontrar famílias responsáveis.
      </p>

      <div class="actions">
        <a class="btn btn-primary" href="{{ route('gatos') }}">Ver gatos disponíveis</a>
        <a class="btn btn-outline" href="{{ route('doacoes') }}">Apoiar com doação</a>
      </div>
    </div>

    <img class="about-img" src="{{ asset('img/cat2.jpg') }}" alt="Gato do gatil">
  </section>

  <section class="about-grid">
    <article class="card">
      <h3>A nossa missão</h3>
      <p>
        Reduzir o abandono animal, promover a adoção responsável e garantir condições dignas a cada gato acolhido.
        Fazemos o possível com os recursos disponíveis, com foco em bem-estar e acompanhamento.
      </p>
    </article>

    <article class="card">
      <h3>O que defendemos</h3>
      <p>
        Bem-estar animal em primeiro lugar, transparência, responsabilidade e adoção consciente.
        Preferimos processos bem feitos do que “despachar” adoções.
      </p>
    </article>

    <article class="card">
      <h3>Como funcionamos</h3>
      <p>
        Cada gato passa por adaptação e socialização. Sempre que possível, garantimos avaliação veterinária,
        desparasitação, vacinação e esterilização antes da adoção.
      </p>
    </article>

    <article class="card">
      <h3>Adoção responsável</h3>
      <p>
        A adoção é compromisso. Procuramos famílias preparadas para tempo, custos e responsabilidade.
        O objetivo é reduzir devoluções e abandono.
      </p>
    </article>
  </section>

  <section class="card mt-16">
    <h3>Voluntariado e apoio</h3>
    <p>
      Precisamos de ajuda com tarefas no espaço, transportes, divulgação e recolha de materiais
      (ração, areia, medicamentos). Se quiseres contribuir, fala connosco.
    </p>

    <div class="actions">
      <a class="btn btn-success" href="{{ route('contactos') }}">Contactar</a>
      <a class="btn btn-outline" href="{{ route('voluntarios') }}">Ser voluntário</a>
    </div>
  </section>

  <section class="hero mt-16">
    <h2 style="margin:0 0 8px; font-size:22px;">Transparência acima de tudo</h2>
    <p style="margin:0; max-width: 820px;">
      O nosso trabalho depende de confiança. Preferimos explicar exatamente o que fazemos, como fazemos,
      e o que precisamos — sem histórias inventadas.
    </p>
  </section>
@endsection
