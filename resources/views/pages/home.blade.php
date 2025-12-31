@extends('layouts.app')

@section('title', 'Home')

@section('content')
  {{-- HERO --}}
  <div class="hero hero-home">
     <div>
       <h1>Bem-vindo ao Gatil Arca d’Água</h1>

       <p>
         Somos uma associação dedicada ao resgate, cuidado e adoção responsável
         de gatos abandonados. Aqui podes conhecer os gatos disponíveis,
         apoiar com doações e entrar em contacto connosco.
       </p>

       <div class="actions">
         <a href="{{ route('gatos') }}" class="btn btn-primary">
           Ver gatos disponíveis
         </a>
         <a href="{{ route('doacoes') }}" class="btn btn-success">
           Apoiar com doação
         </a>
       </div>
     </div>

     <div class="hero-right">
       <img src="{{ asset('img/logo.jpg') }}" alt="Gatil Arca d’Água">
     </div>
  </div>

  {{-- O QUE FAZEMOS --}}
  <section class="grid mt-16">
    <article class="card">
      <h3>Resgate e acolhimento</h3>
      <p>
        Resgatamos gatos em situação de abandono ou risco e garantimos um espaço seguro até serem adotados.
      </p>
      <a class="btn btn-outline" href="{{ route('quem_somos') }}">Saber mais</a>
    </article>

    <article class="card">
      <h3>Cuidados veterinários</h3>
      <p>
        Sempre que possível, garantimos avaliação veterinária, vacinação, desparasitação e esterilização.
      </p>
      <a class="btn btn-outline" href="{{ route('doacoes') }}">Ver como ajudar</a>
    </article>

    <article class="card">
      <h3>Adoção responsável</h3>
      <p>
        Procuramos famílias conscientes e acompanhamos o processo para reduzir devoluções e abandono.
      </p>
      <a class="btn btn-outline" href="{{ route('gatos') }}">Ver lista</a>
    </article>
  </section>

  {{-- COMO PODES AJUDAR --}}
  <section class="grid mt-16">
    <article class="card span-2 success">
      <h3>Como podes ajudar</h3>
      <p>
        Mesmo que não possas adotar, podes apoiar o nosso trabalho de várias formas:
        doações, voluntariado, divulgação e entrega de materiais (ração, areia, medicamentos).
      </p>

      <div class="actions">
        <a class="btn btn-success" href="{{ route('doacoes') }}">Fazer doação</a>
        <a class="btn btn-outline" href="{{ route('contactos') }}">Falar connosco</a>
      </div>
    </article>

    <article class="card">
      <h3>Avaliações</h3>
      <p>
        Feedback de quem adotou e acompanhou o nosso trabalho. Transparência conta.
      </p>
      <a class="btn btn-outline" href="{{ route('avaliacoes.index') }}">
        Ver avaliações
      </a>
    </article>
  </section>

  {{-- FRASE FINAL (sem inline styles, visual igual) --}}
  <section class="hero mt-16">
    <h2 class="section-title">Transparência e bem-estar animal</h2>
    <p class="section-text">
      Cada adoção é uma responsabilidade. O nosso foco é garantir condições dignas e encontrar famílias
      preparadas para um compromisso real.
    </p>
  </section>
@endsection
